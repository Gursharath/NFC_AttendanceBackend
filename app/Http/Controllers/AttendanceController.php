<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function mark(Request $request)
    {
        $request->validate(['nfc_id' => 'required']);
        $student = Student::where('nfc_id', $request->nfc_id)->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $date = Carbon::today();
        $time = Carbon::now()->format('H:i:s');

        $attendance = Attendance::firstOrCreate(
            ['student_id' => $student->id, 'date' => $date],
            ['time_marked' => $time, 'status' => 'present']
        );

        return response()->json([
            'message' => 'Attendance marked',
            'student' => $student->name,
            'date' => $date->toDateString(),
            'time' => $time
        ]);
    }

    public function today()
    {
        return Attendance::with('student')->orderBy('date', 'desc')->get();
    }

    public function history($id)
    {
        $student = Student::findOrFail($id);
        return Attendance::where('student_id', $id)->orderBy('date', 'desc')->get();
    }
}
