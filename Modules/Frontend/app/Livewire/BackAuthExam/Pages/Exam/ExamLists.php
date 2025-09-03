<?php

namespace Modules\Frontend\Livewire\BackAuthExam\Pages\Exam;

use App\Models\Exam;
use Livewire\Attributes\Title;
use Livewire\Component;

class ExamLists extends Component
{
    public $exams;

    public function mount()
    {
        $this->exams = Exam::where('status', 1)->get();
    }

    #[Title('مشاهده لیست آزمون ها')]
    public function render()
    {
        return view('frontend::livewire.back-auth-exam.pages.exam.exam-lists');
    }
}
