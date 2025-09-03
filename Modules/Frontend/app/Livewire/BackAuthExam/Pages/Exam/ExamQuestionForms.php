<?php

namespace Modules\Frontend\Livewire\BackAuthExam\Pages\Exam;

use App\Models\Exam;
use App\Models\Option;
use App\Models\UserExam;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

class ExamQuestionForms extends Component
{
    public $exam;
    public $userExam;
    public $token;

    public $startTime;
    public $durationMinutes;
    public $remainingSeconds;

    public $questions = [];

    public $currentIndex = 0;
    public $answers = [];

    //بعد از آزمون به کاربر تحویل داده میشود و در حالت default null خواهد بود و برای پیگیری از طرف admin اهمیت دارد
    public $testCheckCode;




    public function mount(Exam $exam, UserExam $userExam)
    {
        $this->exam = $exam;
        $this->userExam = $userExam;
        $this->title = $exam->name;

        $this->startTime = session()->get('exam.' . $exam->id . '.start_time');
        $this->durationMinutes = session()->get('exam.' . $exam->id . '.duration');
        $this->token = session()->get('exam.' . $exam->id . '.token');

        if ($userExam->token != $this->token) {
            abort(403, 'شما دسترسی به این آزمون ندارید');
        }

        // بارگذاری سوال‌ها همراه آپشن‌ها
        $this->questions = $exam->questions()->with('options')->get()->toArray();

        $this->updateRemaining();
    }

    public function updateRemaining()
    {
        $endTime = Carbon::parse($this->startTime)->addMinutes($this->durationMinutes);
        $this->remainingSeconds = now()->diffInSeconds($endTime, false);
    }



    public $loadingOption = null; // برای نمایش اسپینر

    public function saveAnswer($answerId)
    {
        $this->loadingOption = $answerId;

        // یه تاخیر کوچیک برای نمایش اسپینر
        $this->dispatch('option-selected', id: $answerId);

        $question = $this->exam->questions[$this->currentIndex];
        $this->answers[$question->id] = $answerId;

        $this->loadingOption = null;

        // اگر همه سوال‌ها جواب داده شدن
        if (count($this->answers) == $this->exam->questions->count()) {
            $this->storeAnswers();

            session()->forget([
                'exam.' . $this->exam->id . '.start_time',
                'exam.' . $this->exam->id . '.duration',
                'exam.' . $this->exam->id . '.token',
            ]);

            session()->flash('success', 'آزمون شما به پایان رسید و پاسخ‌ها ذخیره شدند.');
        }
    }


    public function storeAnswers()
    {
        $userId = Auth::id();
        $score = 0; // شمارنده امتیاز

        foreach ($this->answers as $questionId => $optionId) {
            $option = Option::find($optionId);

            // اگر گزینه صحیح بود → یک امتیاز اضافه کن
            if ($option && $option->is_correct) {
                $score++;
            }

            UserAnswer::updateOrCreate(
                [
                    'user_exam_id' => $this->userExam->id,
                    'question_id'  => $questionId,
                    'option_id' => $optionId,
                ]
            );
        }

        // ساخت کد پیگیری آزمون
        $this->testCheckCode = Str::random(5);

        // آپدیت جدول user_exams با امتیاز
        $this->userExam->update([
            'test_check_id' => $this->testCheckCode,
            'score'         => $score,
        ]);

        // -------------------
        // <div class="text-foreground text-xl font-bold">امتیاز شما: {{ $score }}</div>
        // -------------------
    }



    public $examFinished = false;



    #[Title('دادن آزمون')]
    public function render()
    {
        $this->updateRemaining();


        // اگر flash success ست شده یا زمان تموم شده
        if (session()->has('success') || $this->remainingSeconds <= 0) {
            $this->examFinished = true;

            // ذخیره پاسخ‌ها اگر هنوز ذخیره نشده
            if (!session()->has('success')) {
                $this->storeAnswers();

                session()->forget([
                    'exam.' . $this->exam->id . '.start_time',
                    'exam.' . $this->exam->id . '.duration',
                    'exam.' . $this->exam->id . '.token',
                ]);

                session()->flash('success', 'آزمون شما به پایان رسید و پاسخ‌های شما ذخیره شدند.');
            }
        }


        // اگر زمان تموم شده باشه و هنوز پاسخ‌ها ذخیره نشده
        if ($this->remainingSeconds <= 0 && !session()->has('exam_finished_' . $this->userExam->id)) {
            $this->storeAnswers();

            session()->forget([
                'exam.' . $this->exam->id . '.start_time',
                'exam.' . $this->exam->id . '.duration',
                'exam.' . $this->exam->id . '.token',
            ]);

            // علامت میزنیم که آزمون تموم شده و پیام flash نمایش داده بشه
            session()->flash('success', 'زمان آزمون به پایان رسید و پاسخ‌های شما ذخیره شدند.');

            // جلوگیری از ذخیره مجدد
            session()->put('exam_finished_' . $this->userExam->id, true);
        }

        return view('frontend::livewire.back-auth-exam.pages.exam.exam-question-forms');
    }
}
