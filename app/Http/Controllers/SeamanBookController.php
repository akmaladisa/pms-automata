<?php

namespace App\Http\Controllers;

use App\Models\SeamanBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SeamanBookController extends Controller
{
    public function read()
    {
        return response()->json([
            'seaman_books' => SeamanBook::where('status', 'ACT')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'number' => 'required',
            'institution_name' => 'required',
            'issued_date' => 'required',
            'expired_date' => 'required',
            'warning_period' => 'required|before:expired_date',
            'book_scan' => 'mimes:pdf,docx,doc',
            'remarks' => "required",
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $seaman_book = new SeamanBook();
        $seaman_book->id_crew = $request->id_crew;
        $seaman_book->number = $request->number;
        $seaman_book->institution_name = $request->institution_name;
        $seaman_book->issued_date = $request->issued_date;
        $seaman_book->expired_date = $request->expired_date;
        $seaman_book->warning_period = $request->warning_period;
        $seaman_book->remarks = $request->remarks;
        $seaman_book->status = $request->status;

        if( $request->file('book_scan') ) {
            $seaman_book->book_scan = $request->file('book_scan')->store('seaman-book');
        }

        $seaman_book->save();

        return response()->json([
            'status' => 200,
            'message' => "Seaman book added"
        ]);

    }

    public function show($id)
    {
        $seaman_book = SeamanBook::find($id);

        if( $seaman_book ) {
            return response()->json([
                'status' => 200,
                'seaman_book' => $seaman_book,
                'crew_name' => $seaman_book->crew->full_name
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function update( Request $request, $id )
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'number' => 'required',
            'institution_name' => 'required',
            'issued_date' => 'required',
            'expired_date' => 'required',
            'warning_period' => 'required|before:expired_date',
            'book_scan' => 'mimes:pdf,docx,doc',
            'remarks' => "required",
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $seaman_book = SeamanBook::find($id);

        if( $seaman_book ) {
            
            $seaman_book->id_crew = $request->id_crew;
            $seaman_book->number = $request->number;
            $seaman_book->institution_name = $request->institution_name;
            $seaman_book->issued_date = $request->issued_date;
            $seaman_book->expired_date = $request->expired_date;
            $seaman_book->warning_period = $request->warning_period;
            $seaman_book->remarks = $request->remarks;
            $seaman_book->status = $request->status;

            if( $request->file('book_scan') ) {
                Storage::delete( $seaman_book->book_scan );
                $seaman_book->book_scan = $request->file('book_scan')->store('seaman-book');
            }

            $seaman_book->save();

            return response()->json([
                'status' => 200,
                'message' => "Seaman book updated"
            ]);

        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);

    }

    public function destroy($id)
    {
        $seaman_book = SeamanBook::find($id);
        if( $seaman_book ) {
            $seaman_book->status = "DE";
            $seaman_book->save();
            return response()->json([
                'status' => 200,
                'message' => "Seaman book deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

}
