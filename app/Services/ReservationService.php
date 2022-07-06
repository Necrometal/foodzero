<?php

namespace App\Services;

use App\Mail\ReservationBook;
use App\Models\Reservation;
use Exception;
use Illuminate\Support\Facades\Mail;

class ReservationService {
  
    public function reservation($request){
        try{
            $reservation = Reservation::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'hour' => $request->hour,
                'date' => $request->date,
                'person' => $request->person,
            ]);

            $this->sendEmailAfterReservation($reservation);

            return $reservation;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function listsAll($request){
        $query = Reservation::orderBy('created_at', 'desc');

        $reservation = $query->paginate(10, ['*'], 'page', ($request && $request->page) ? $request->page : 1);

        return $reservation;
    }

    /**
     * @param Reservation $reservation
     */
    private function sendEmailAfterReservation($reservation){
        Mail::to($reservation->email)->send(new ReservationBook($reservation));
    }

}