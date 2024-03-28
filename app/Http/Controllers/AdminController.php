<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Charts\payementMethod;
use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Charts\PaymentMethodChart;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Agencie;
use App\Models\Car;
use App\Models\Charge;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function dashboard()
    {
        $chiffreAffaire = $this->userAuth()->Totalbookings();
        $Charge = $this->userAuth()->Totalcharges();
        $Profite = $this->userAuth()->TotalProfite();
        $payements = $this->userAuth()->Totalpayements();
        $unpayed = $this->userAuth()->Totalunpayed();

        $nbClient = Count($this->userAuth()->clients);
        $nbCarsParc = Count(Car::where('etat', 'en parc')->where('agence_id', $this->userAuth()->id)->get());
        $nbCarsOut = Count(Car::where('etat', 'sortie')->where('agence_id', $this->userAuth()->id)->get());
        $nbCarsReparation = Count(Car::where('etat', 'panne')->where('agence_id', $this->userAuth()->id)->get());
        $bookings = $this->userAuth()->bookings;
        $nbTasks = Count($this->userAuth()->tasks);

        $nbBookings = Count($bookings);
        $nbCars = Count($this->userAuth()->cars);

        // Add any logic to retrieve data for the admin dashboard
        return view('admin.dashboard', compact('nbClient', 'chiffreAffaire', 'nbBookings', 'nbCars', 'nbTasks', 'nbCarsParc', 'nbCarsOut', 'nbCarsReparation', 'Charge', 'Profite', 'payements', 'unpayed'));
    }

    public function updateOnlineStatus(Request $request)
    {

        // Retrieve the boolean value from the request
        $status = $request->status === "on";
        $agence = $this->userAuth();
        $agence->online = $status;
        $agence->save();
        return redirect()->route('payment')->with('success', 'Payment recorded successfully.');
    }
    public function index()
    {
        $agencies = Agencie::all();
        return view('admin.index', compact('agencies'));
    }
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        try {
            $password = Str::random(8);
            $request->merge(['password' => $password]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::where('email', $request->email)->first();
            $agency = Agencie::create($request->all());
            $agency->user = $user->id;
            $user->role = 'admin';
            $user->activation = true;
            $agency->save();
            $user->save();
            $subject = 'Welcome to Flent ';
            $content = "
        <p>Hello {{ $user->name }},</p>
        <p>Your account has been created successfully. Below is your auto-generated password:</p>
        <p><strong>Password:</strong> {{ $password }}</p>
        <p>Please keep this password secure and do not share it with anyone.</p>
        <p>Thank you,</p>
        <p>Your Admin Team</p>
            ";
            //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));
            $traccar = new TraccarController();
            $traccar->storeGroupe($agency->name);

            $response = $traccar->getGroupIdByName($agency->name);

            if ($response->getStatusCode() === 200) {
                $groupId = $response->getData()->group_id;

                $agency->groupId = $groupId;


                $agency->save();

                return redirect()->route('admin.index')->with('success', 'Agency created successfully. Password sent to user email.');
            } else {
                return response()->json(['error' => 'Failed to retrieve group ID'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $agencie = Agencie::findOrFail($id);
        return view('admin.show', ['agencie' => $agencie]);
    }

    public function edit($id)
    {
        $agencie = Agencie::findOrFail($id);
        return view('admin.edit', ['agencie' => $agencie]);
    }

    public function update(Request $request, $id)
    {
        $agencie = Agencie::findOrFail($id);
        $agencie->update($request->all());
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $agencie = Agencie::findOrFail($id);
        $agencie->delete();
        return redirect()->route('admin.index');
    }
}
