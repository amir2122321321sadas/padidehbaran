<?php

namespace Modules\Frontend\Livewire\BackAuthExam\Pages\Exam;

use App\Models\Exam;
use App\Models\UserExam;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ExamFormForStart extends Component
{

    public $examDurationMinutes;
    public $exam;
    #[Validate]
    public $fullName;

    #[Validate]
    public $phone;

    #[Validate]
    public $email;


    public function rules(): array
    {
        return [
            'fullName' => 'required|min:5|max:255',
            'phone' => 'required|digits:11|unique:user_exams,phone|',
            'email' => 'nullable|email',
        ];
    }

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->examDurationMinutes = $this->exam->time;
    }

    public function startExam()
    {
        $this->validate();

        $userExam = UserExam::create([
            'exam_id' => $this->exam->id,
            'full_name' => $this->fullName,
            'phone' => $this->phone,
            'email' => $this->email ?? '',
            'token' => Str::random(16),
        ]);

        if ($userExam) {
            session()->put('exam.' . $this->exam->id . '.start_time', now());
            session()->put('exam.' . $this->exam->id . '.duration', $this->examDurationMinutes);
            session()->put('exam.' . $this->exam->id . '.token', $userExam->token);

            return redirect()->route('exam-questions' , [$userExam->token , $this->exam]);

        }


    }

    #[Title('شروع آزمون')]
    public function render()
    {
        return view('frontend::livewire.back-auth-exam.pages.exam.exam-form-for-start');
    }
}
