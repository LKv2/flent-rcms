<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\Task;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateCarTask extends Command
{
    protected $signature = 'app:create-car-task';
    protected $description = 'Create tasks based on car conditions.';

    public function handle()
    {
        $currentDate = new DateTime();
            $vidangeAlert = config('app.VIDANGE_ALERT', 7000);
            $vidangeAlertmax = config('app.VIDANGE_MAX', 10000);

            $cars = Car::all();

            foreach ($cars as $car) {
                $this->processInsurance($car, $currentDate);
                $this->processVignette($car, $currentDate);
                $this->processVidange($car, $vidangeAlert, $vidangeAlertmax, $currentDate); // Pass $currentDate here
                $this->processAutorisationCirculation($car, $currentDate);
                $this->processCarteGrise($car, $currentDate);
                $this->processControlTechnique($car, $currentDate);
            }
    }

    private function processInsurance($car, $currentDate)
    {
        try {
            $joursRestantsInsurance = $currentDate->diff(new DateTime($car->date_validite_issurrance))->days;

            if ($currentDate < new DateTime($car->date_validite_issurrance)) {
                $this->createCarTask($car, 'Insurance Renewal', $joursRestantsInsurance, 'not expired', $car->date_validite_issurrance);
            } else {
                $this->createCarTask($car, 'Insurance Renewal', $joursRestantsInsurance, 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing insurance for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function processVignette($car, $currentDate)
    {
        try {
            $joursRestantsVignette = $currentDate->diff(new DateTime($car->date_validite_vingnette))->days;

            if ($currentDate < new DateTime($car->date_validite_vingnette)) {
                $this->createCarTask($car, 'Vignette Renewal', $joursRestantsVignette, 'not expired', $car->date_validite_vingnette);
            } else {
                $this->createCarTask($car, 'Vignette Renewal', $joursRestantsVignette, 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing vignette for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function processVidange($car, $vidangeAlert, $vidangeAlertmax, $currentDate)
    {
        try {
            $daysForVidange = $car->km - $car->kmvidange;
            $tempDate = clone $currentDate; // Create a copy of $currentDate

            if ($daysForVidange >= $vidangeAlert && $daysForVidange < $vidangeAlertmax) {
                $day = $daysForVidange / $car->kmjr;
                $this->createCarTask($car, 'Vidange', $daysForVidange . 'km', 'not expired', $tempDate->modify('+' . $day . ' days')); // Use $tempDate here
            } elseif ($daysForVidange >= $vidangeAlertmax) {
                $this->createCarTask($car, 'Vidange', $car->km .  ' km est depassee de ' . ($daysForVidange - $vidangeAlertmax) . ' km', 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing vidange for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function processAutorisationCirculation($car, $currentDate)
    {
        try {
            $dateValiditeAutorisation = new DateTime($car->date_validite_autorisation);
            $joursRestantsAutorisation = $dateValiditeAutorisation->diff($currentDate)->days;

            if ($joursRestantsAutorisation >= 0 && $currentDate < $dateValiditeAutorisation) {
                $this->createCarTask($car, 'Autorisation Circulation', $joursRestantsAutorisation, 'not expired', $dateValiditeAutorisation);
            } else {
                $this->createCarTask($car, 'Autorisation Circulation', $joursRestantsAutorisation, 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing autorisation circulation for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function processCarteGrise($car, $currentDate)
    {
        try {
            $dateValiditeCG = new DateTime($car->date_validite_CG);
            $joursRestantsCG = $dateValiditeCG->diff($currentDate)->days;

            if ($joursRestantsCG >= 0 && $currentDate < $dateValiditeCG) {
                $this->createCarTask($car, 'Carte Grise', $joursRestantsCG, 'not expired', $dateValiditeCG);
            } else {
                $this->createCarTask($car, 'Carte Grise', $joursRestantsCG, 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing carte grise for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function processControlTechnique($car, $currentDate)
    {
        try {
            $dateValiditeControl = new DateTime($car->date_validite_control);
            $joursRestantsControl = $dateValiditeControl->diff($currentDate)->days;

            if ($joursRestantsControl >= 0 && $currentDate < $dateValiditeControl) {
                $this->createCarTask($car, 'Control Technique', $joursRestantsControl, 'not expired', $dateValiditeControl);
            } else {
                $this->createCarTask($car, 'Control Technique', $joursRestantsControl, 'expired', $currentDate);
            }
        } catch (\Exception $e) {
            Log::error("Error processing control technique for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }

    private function createCarTask($car, $title, $daysRemaining, $status, $date)
    {
        try {
            $existingTask = Task::where('title', $title)
                ->where('user_id', $car->id)
                ->where('agence_id', $car->agence_id)
                ->first();

            if ($existingTask) {
                $existingTask->update([
                    'description' => "Days remaining: $daysRemaining, Status: $status .",
                    'date' => $date,
                ]);

                $formattedDate = $date->format('Y-m-d H:i:s'); // Format the date
                Log::info("Task updated: $title for Car ID: {$car->id}, Date: $formattedDate");
            } else {
                Task::create([
                    'title' => $title,
                    'user_id' => $car->id,
                    'description' => "Days remaining: $daysRemaining, Status: $status .",
                    'status' => 'To-Do',
                    'type' => 'Car Task',
                    'date' => $date,
                    'agence_id' => $car->agence_id
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Error creating car task for Car ID: {$car->id}: {$e->getMessage()}");
        }
    }
}

