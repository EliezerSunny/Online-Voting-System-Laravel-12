<?php

namespace App\Livewire\Auth;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Mail\LoginUserMail;
use App\Models\VoteSession;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function login()
    {
        
        
        $voting = VoteSession::where('active', true)
        ->where("vote_ends_at", ">=", now())
        ->first();

        $allowAdmin = User::where('is_admin', false)->first();

        if ($voting && $allowAdmin) {

            return redirect()->back()->with("error", "Voting Ended! You Can't Login.");
        }


        $userMail = User::where('email', $this->email)->first()->fresh();



        if ($userMail && $userMail->vote == true) {

            // session()->flash("error", "You've Already Voted and can't login again.");

            return redirect()->back()->with("error", "You've Already Voted and can't login again.");
        }

        


        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        
        

        $user = Auth::user();
        $user->status = 'Online';
        $user->last_seen = now();
        $user->save();
        


        $ipAddress = request()->ip();
        // Optional: Get location using IP
        $location = 'Unknown';
        try {
            $response = Http::get("http://ip-api.com/json/{$ipAddress}");
            $data = $response->json();
            $location = $data['city'] . ', ' . $data['country'];
        } catch (Exception $e) {
            // Log error or set default location
        }

        // $loginTime = now()->format('Y-m-d H:i:s');
        // $loginUrl = route('cast-vote'); // replace with your route



        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

    //     Mail::to($user['email'])->send(new LoginUserMail($user, 
    //     $ipAddress,
    //     $location,
    //     $loginTime,
    //     $loginUrl
    // ));

    

        $this->redirectIntended(route('cast-vote'), navigate: true);

        session()->flash("success", "Successfully Logged In !!!");




    
    
        
    }



    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }



}
