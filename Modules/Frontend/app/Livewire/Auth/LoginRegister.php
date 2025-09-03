<?php

namespace Modules\Frontend\Livewire\Auth;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginRegister extends Component
{

    public $title = 'پدیده باران | ورود و ثبت نام';
    public ?bool $resetPasswordForm = false;
    public ?bool $verifyCodeForgotPassword = false;
    public ?bool $forgotForm = false;
    public ?bool $loginForm = true;
    public ?bool $registerForm = false;

    #[Validate('required|digits:10|numeric')]
    public $national_code;

    #[Validate('required|min:6')]
    public $password;

    #[Validate('required|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/|unique:users,email')]
    public $email;

    #[Validate('required|min:6')]
    public $identification_code;

    #[Validate('required|min:6')]
    public $forgot_field_input;

    #[Validate('required|digits:6|numeric')]
    public $verify_code_forgot_password;



    #[Validate('required|min:6')]
    public $newPassword;
    public $conformNewPassword;


    public function enableRegisterForm(){
        $this->loginForm = false;
        $this->registerForm = true;
    }

    public function enableLoginForm(){
        $this->registerForm = false;
        $this->loginForm = true;
    }

    public function enableforgotForm()
    {
        $this->loginForm = false;
        $this->registerForm = false;
        $this->forgotForm = true;
    }












public function mount()
{
 //
}



    public function register()
    {
        $this->validateOnly('national_code');
        // چک کردن تکراری نبودن national_code در جدول user_information
        $existsNationalCode = UserInformation::where('national_code', $this->national_code)->exists();
        if ($existsNationalCode) {
            $this->addError('national_code', 'کد ملی وارد شده قبلا ثبت شده است.');
            return;
        }
        $this->validateOnly('email');
        $this->validateOnly('password');
        $this->validateOnly('identification_code');



        $user_identification_code = User::where('identification_code', $this->identification_code)->first();

        if(!$user_identification_code){
            $this->addError('identification_code', 'کد معرف وارد شده وجود ندارد.');
            return;
        }

        $identification_code = bin2hex(random_bytes(6));
        $user = User::create([
            'password' => Hash::make($this->password),
            'email' => $this->email,
            'identification_code' => $identification_code,
        ]);
        $user->save();
        $user_information = UserInformation::create([
            'user_id' => $user->id,
            'identification_code' => $user_identification_code->id,
            'national_code' => $this->national_code,
        ]);
        $user_information->save();
        Auth::login($user);

//        $user->assignRole('admin');

        return redirect()->route('home');
    }














    public function login()
    {
        $this->validateOnly('national_code');
        $this->validateOnly('password');
        // تلاش برای ورود کاربر با national_code و password
        $userInfo = \App\Models\UserInformation::where('national_code', $this->national_code)->first();



        if (!$userInfo || !$userInfo->user_id) {
            $this->addError('national_code', 'کد ملی یا رمز عبور اشتباه است.');
            return;
        }


        $user = \App\Models\User::find($userInfo->user_id);
        if (!$user || !\Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
            $this->addError('national_code', 'کد ملی یا رمز عبور اشتباه است.');
            return;
        }








        $userchecker = \App\Models\User::find($userInfo->user_id);


        if ($userchecker->isBanned()) {
            // فرض می‌کنیم رابطه user -> insurances تعریف شده
            $lastInsurance = $user->insurancePolicies()->latest('created_at')->first();

            if ($lastInsurance) {
                $diffMonths = Carbon::parse($lastInsurance->created_at)->diffInMonths(now());

                if ($diffMonths >= 3 && !$user->isBanned()) {
                    //
                }else{
                    $userchecker->unban();
                }
            }
        }



        if ($userchecker->isBanned()) {
            $this->addError('national_code', 'پروفایل شما به دلیل عدم فعالیت غیرفعال شده است!');
            return; // متن بن
        }

         \Illuminate\Support\Facades\Auth::login($user);

//        $user->assignRole('admin');

        return redirect(route('home'));


    }









    public function forgot()
    {
        $this->validateOnly('forgot_field_input');

        $input = $this->forgot_field_input;

        // تلاش برای پیدا کردن کاربر با ایمیل یا کد ملی
        $user = null;

        // اگر ورودی ایمیل باشد
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $user = \App\Models\User::where('email', $input)->first();
        } else {
            // فرض بر این است که ورودی کد ملی است
            $userInfo = \App\Models\UserInformation::where('national_code', $input)->first();
            if ($userInfo && $userInfo->user_id) {
                $user = \App\Models\User::find($userInfo->user_id);
            }
        }

        if (!$user || !$user->email) {
            $this->addError('forgot_field_input', 'کاربری با این اطلاعات یافت نشد.');
            return;
        }

    // تولید یک کد 6 رقمی تصادفی
    $verificationCode = random_int(100000, 999999);

    // ذخیره کد در سشن یا دیتابیس (اینجا سشن برای سادگی)
    session(['password_reset_code' => $verificationCode, 'password_reset_user_id' => $user->id]);

    // ارسال ایمیل به کاربر
    \Illuminate\Support\Facades\Mail::raw(
        "کد بازیابی رمز عبور شما: {$verificationCode}",
        function ($message) use ($user) {
            $message->to($user->email)
                ->subject('کد بازیابی رمز عبور');
        }
    );

    $this->forgotForm = false;
    $this->verifyCodeForgotPassword = true;

    // می‌توانید یک پیام موفقیت یا ریدایرکت به فرم وارد کردن کد ارسال کنید
    session()->flash('success', 'کد بازیابی رمز عبور به ایمیل شما ارسال شد.');
    }










    public function verifyCodeForgot()
    {
        $this->validateOnly('verify_code_forgot_password');

        $enteredCode = $this->verify_code_forgot_password;
        $sessionCode = session('password_reset_code');

        if ($enteredCode != $sessionCode) {
            $this->addError('verify_code_forgot_password', 'کد وارد شده صحیح نیست.');
            return;
        }

        // اگر کد صحیح بود، می‌توانید ادامه فرآیند (مثلا نمایش فرم تغییر رمز) را فعال کنید
        $this->verifyCodeForgotPassword = false;
        $this->resetPasswordForm = true;
    }










    public function changePassword()
    {
        // اعتبارسنجی فیلدها
        $this->validate([
            'newPassword' => 'required|min:6',
            'conformNewPassword' => 'required|same:newPassword',
        ]);

        // دریافت آیدی کاربر از سشن
        $userId = session('password_reset_user_id');
        if (!$userId) {
            $this->addError('newPassword', 'خطا در فرآیند بازیابی رمز عبور. لطفا مجددا تلاش کنید.');
            return;
        }

        // پیدا کردن کاربر
        $user = User::find($userId);
        if (!$user) {
            $this->addError('newPassword', 'کاربر یافت نشد.');
            return;
        }

        // تغییر رمز عبور
        $user->password = Hash::make($this->newPassword);
        $user->save();

        // پاک کردن اطلاعات سشن بازیابی رمز
        session()->forget(['password_reset_code', 'password_reset_user_id']);

        // ریست فرم‌ها و نمایش پیام موفقیت
        $this->reset(['newPassword', 'conformNewPassword']);
        $this->resetPasswordForm = false;
        $this->loginForm = true;

        session()->flash('success', 'رمز عبور با موفقیت تغییر کرد. اکنون می‌توانید وارد شوید.');
    }







    #[Title('ثبت نام و ورود')]
    public function render()
    {
        return view('frontend::livewire.auth.login-register');
    }
}
