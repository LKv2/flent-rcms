<?php

namespace App\Http\Controllers;

use App\Models\Agencie;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Charge;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // app/Http/Controllers/TaskController.php
    public function index()
    {
        $tasks = Auth::user()->tasks;

        return view('task.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        Task::Create(
            [
                'title' => $request->title,
                'user_id' => 0,
                'type' => 'Simple Task',
                'date' => $request->date,
                'description' => $request->description,
                'agence_id' => Auth::user()->id,
                'status' => 'To-Do',
            ]
        );
        return redirect()->route('tasks.index');
    }


    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->user_id = 0;
        $task->type = 'Simple Task';
        $task->description = $request->description;
        $task->status = 'To-Do';
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
    public function done($id, Request $request)
    {
        $task = Task::find($id);

        if ($task->type == 'Car Task') {
            $charge = new Charge();
            $car[0] = Car::find($task->user_id);
            $immatriculation = $car[0]->immatriculation1 ? $car[0]->immatriculation1 . "/" . $car[0]->lettre . "/" . $car[0]->immatriculation2 : $car[0]->immatriculationWW;
            switch ($task->title) {
                case ('Vidange'):
                    $car[0]->kmvidange = $request->kmvidange;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
                case ('Autorisation Circulation'):
                    $car[0]->date_validite_autorisation = $request->date_validite_autorisation;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
                case ('Control Technique'):
                    $car[0]->date_validite_control = $request->date_validite_control;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
                case ('Carte Grise'):
                    $car[0]->date_validite_CG = $request->date_validite_CG;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
                case ('Vignette Renewal'):
                    $car[0]->date_validite_vingnette = $request->date_validite_vingnette;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
                case ('Insurance Renewal'):
                    $car[0]->date_validite_issurrance = $request->date_validite_issurrance;
                    $charge->type = $task->title;
                    $charge->description = 'Car ' . $immatriculation . ' : ' . $task->description;
                    break;
            }
            $charge->amount = $request->cout;
            $charge->date = $request->date;
            $charge->car = $car[0]->id;
            $charge->agence_id = $task->agence_id;
            $charge->save();
            $car[0]->save();
        }
        if ($task->type == 'Booking Task') {
            $b = new BookingController();
            if (str_contains($task->title, 'Checkout')) {
                $b->close($task->user_id, $request);
            } else {
                $b->open($task->user_id, $request);
            }
        }
        $task->status = 'Done';
        $task->save();
        return redirect()->route('tasks.index');
    }
    public function todo($id)
    {
        $task = Task::find($id);
        $task->status = 'To-Do';
        $task->save();
        return redirect()->route('tasks.index');
    }
    public function inprogress($id)
    {
        $task = Task::find($id);
        $task->status = 'In Progress';
        $task->save();
        return redirect()->route('tasks.index');
    }
    public function updateStatus($id)
    {

        $task = Task::find($id);

        if ($task->type === 'Car Task') {
            $car[0] = Car::find($task->user_id);
            return view('task.result', compact('task', 'car'));
        } elseif ($task->type === 'Booking Task') {
            $booking = Booking::find($task->user_id);
            return view('task.result', compact('task', 'booking'));
        } else {

            $task->status = 'Done';
            $task->save();
            return redirect()->route('tasks.index');
        }
    }
    public function getTasksByDate($date)
    {
        $tasks = Auth::user()->tasks()->where('date', $date)->get();

        return response()->json(['tasks' => $tasks]);
    }
}
