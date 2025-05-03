<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\User;

use DB;
use Str;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $login = $request->name;
        $password = $request->password;
        $email = $request->email;

        $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
		$ref = 0;
		$ref_id = session('ref_id');
		if ($ref_id > 0){
			$ref = $ref_id;

		}

        switch($request->type) {
            case 'click':
                $login = Str::random(12);
                $password = Str::random(8);
                $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
                $accountCount = User::where('ip', $ip)->count();
                
                if ($accountCount >= 3) {
                    return redirect()->back()->with('error', 'Максимум 3 аккаунта с одного IP адреса');
                }

                $user = User::create([
                    'name'      => $login,
                    'password'   => Hash::make($password), 
                    'avatar' => 'https://cdnjsgame.ru/img/user/twingo.png',
                    'ref_id' => $ref,
                    'ip'    => $ip,
                    'social_id' => Str::random(8)
                ]);
            break;

            case 'login':
                $validator = Validator::make($request->all(), [
                    'name' => [
                        'required',
                        'min:4',
                        'max:12',
                        'unique:users',
                        'regex:/^[a-zA-Z0-9\-_@.]*$/'  
                    ],
                    'email' => [
                        'required',
                        'min:8',
                        'max:40',
                        'unique:users',
                        'regex:/^[a-zA-Z0-9\-_@.]*$/'  
                    ],
                    'password' => [
                        'required',
                        'min:6',
                        'max:32',
                        'regex:/^[a-zA-Z0-9\-_@!*#]*$/'  
                    ],
                ], [
                    'name.unique' => 'Этот логин уже занят',
                    'name.max' => 'Длина логина должна составлять не более 12 знаков',
                    'name.min' => 'Длина логина должна составлять не менее 4 знаков',
                    'email.unique' => 'Этот EMAIL уже занят',
                    'email.regex' => 'Почта может содержать только английские буквы, цифры и специальные символы (-, _, @, !, #)',
                    // Сообщения об ошибках для регулярных выражений
                    'name.regex' => 'Логин может содержать только английские буквы, цифры и специальные символы (-, _, @, .)',
                    'password.regex' => 'Пароль может содержать только английские буквы, цифры и специальные символы (-, _, @, !, #)',
                    'password.min' => 'Длина пароля должна составлять не менее 6 знаков',
                    'password.max' => 'Длина пароля должна составлять не более 32 знаков',
                ]);
        
                if($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
                $accountCount = User::where('ip', $ip)->count();
                
                if ($accountCount >= 3) {
                    return redirect()->back()->with('error', 'Максимум 3 аккаунта с одного IP адреса');
                }

                $user = User::create([
                    'name'      => $login,
                    'password'   => Hash::make($password), 
                    'email'   => $email,
                    'avatar' => 'https://cdnjsgame.ru/img/user/twingo.png',
                    'ref_id' => $ref,
                    'ip' => $ip,
                    'social_id' => Str::random(8)
                ]);

            break;
            default:
                return redirect()->back()->with('error', 'Попробуйте другой способ');
            break;
        }

		if($ref > 0){
            $count_r = User::where('id', $ref_id)->get();
            if(count($count_r) > 0){
                $refs = $count_r[0]->refs + 1;        
                $bonus_refs = $count_r[0]->bonus_refs + 1; 
                User::where('id', $ref_id)->update(['refs' => $refs, 'bonus_refs' => $bonus_refs]); 
            }
        }

        Auth::login($user);
        
        if($request->type == 'click') {
            return redirect('/')->with('register', $login.':'.$password);
        } else {
            return redirect('/');
        }
    }

    public function login(Request $request)
{
        
    $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required',
        ], [
            'login.required' => 'Поле Login обязательно для заполнения.',
            'login.string' => 'Поле Login должно быть строкой.',
            'password.required' => 'Поле пароля обязательно для заполнения.'
        ]);

        
    if ($validator->fails()) {
        return [
            'error' => true,
            'message' => $validator->errors()->first(), 
        ];
    }

    $candidate = User::where('name', $request->login)->first();

    if(!$candidate) {
        return [
            'error' => true,
            'message' => 'Пользователь не найден'
        ];
    }

    if($candidate->password == null) {
        return [
            'error' => true,
            'message' => 'Логин или пароль неверный'
        ];
    }

    
    if (!Hash::check($request->password, $candidate->password)) {
        return [
            'error' => true,
            'message' => 'Неправильный пароль'
        ];
    }    

    Auth::login($candidate);

    return [
        'success' => true,
        'message' => 'Успешный вход, сейчас вы будете перенаправлены'
    ];
}


public function loginEmail(Request $request)
{
        
    $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required',
        ], [
            'email.required' => 'The Email field is required!',
            'email.string' => 'The Email field must be a string!',
            'password.required' => 'The Password field is required!'
        ]);

        
    if ($validator->fails()) {
        return [
            'error' => true,
            'message' => $validator->errors()->first(), 
        ];
    }

    $candidate = User::where('email', $request->email)->first();

    if(!$candidate) {
        return [
            'error' => true,
            'message' => 'No user with this email found!'
        ];
    }

    if($candidate->password == null) {
        return [
            'error' => true,
            'message' => 'Login or password is incorrect'
        ];
    }

    
    if (!Hash::check($request->password, $candidate->password)) {
        return [
            'error' => true,
            'message' => 'Password is incorrect'
        ];
    }    

    Auth::login($candidate);

    return [
        'success' => true,
        'message' => 'Successful login, you will now be redirected'
    ];
}


public function loginPhone(Request $request)
{
        
    $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required',
        ], [
            'phone.required' => 'The phone field is required!',
            'phone.string' => 'The phone field must be a string!',
            'password.required' => 'The Password field is required!'
        ]);

        
    if ($validator->fails()) {
        return [
            'error' => true,
            'message' => $validator->errors()->first(), 
        ];
    }

    $candidate = User::where('phone', $request->phone)->first();

    if(!$candidate) {
        return [
            'error' => true,
            'message' => 'No user with this phone found!'
        ];
    }

    if($candidate->password == null) {
        return [
            'error' => true,
            'message' => 'Phone or password is incorrect'
        ];
    }

    
    if (!Hash::check($request->password, $candidate->password)) {
        return [
            'error' => true,
            'message' => 'Password is incorrect'
        ];
    }    

    Auth::login($candidate);

    return [
        'success' => true,
        'message' => 'Successful login, you will now be redirected'
    ];
}


public function registerQuick(Request $request)
{
    $phone = '+91'.$request->phone;
    $password = $request->password;
    $email = $request->email;
    $telegram_id = $request->telegram_id;
    $external_id = null;

    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

    // 🔐 Data validation
    $validator = Validator::make($request->all(), [
        'phone' => [
            'required',
            'regex:/^\d{10,15}$/',
            'unique:users,phone'
        ],
        'email' => [
            'required',
            'email',
            'min:8',
            'max:40',
            'unique:users,email'
        ],
        'password' => [
            'required',
            'min:6',
            'max:32',
            'regex:/^[a-zA-Z0-9\-_@!*#]*$/'
        ],
        'telegram_id' => [
        'nullable',
        'regex:/^\d+$/', // Только цифры, любая длина
        ],
    ], [
        'phone.required' => 'Please enter a phone number',
        'phone.unique' => 'This phone number is already registered',
        'phone.regex' => 'The phone number must contain only digits and be between 10 to 15 characters long',
        'email.required' => 'Please enter an email address',
        'email.email' => 'Please enter a valid email address',
        'email.unique' => 'This email is already in use',
        'password.required' => 'Please enter a password',
        'password.min' => 'The password must be at least 6 characters',
        'password.max' => 'The password must not exceed 32 characters',
        'password.regex' => 'The password may only contain latin letters, digits, and the following symbols: - _ @ ! * #',
        'telegram_id.regex' => 'Telegram ID must contain only digits',
    ]);

    if ($validator->fails()) {
        return [
            'error' => true,
            'message' => $validator->errors()->first()
        ];
    }

    // 🔒 IP limit check
    $accountCount = User::where('ip', $ip)->count();
    if ($accountCount >= 50) {
        return [
            'error' => true,
            'message' => 'Maximum 50 accounts per IP address'
        ];
    }

    try {
        if (!empty($telegram_id)) { // добавляем проверку, чтобы не дергать пустые запросы
            $external_id = $this->getLeadIdFromTelegram($telegram_id);
        }
    } catch (\Throwable $e) {
        \Log::error('Ошибка на получение external_id: ' . $e->getMessage());
    }

    // ✅ Registration
    $user = User::create([
        'external_id' => $external_id,
        'phone'    => $phone,
        'email'    => $email,
        'password' => Hash::make($password),
        'avatar'   => '/avatar.png',
        'ip'       => $ip,
        'social_id' => Str::random(8),
    ]);

    try {
        $eventId = md5($user->id . ':' . $user->created_at);

        $this->sendPostback([
            'external_id' => $user->external_id,
            'id' => $user->id, // например id платформы
            'event_id' => $eventId, // id события регистрации
            'email' => $user->email,
            'phone' => $user->phone,
            'offer_id' => 154,
            'country_apha2code' => 'IN',
        ]);
    } catch (\Throwable $e) {
        // Просто логируем ошибку, но не останавливаем регистрацию
        \Log::error('Ошибка при отправке постбека: ' . $e->getMessage());
    }

    // 🔐 Authentication
    Auth::login($user);

    return [
        'success' => true,
        'message' => 'Registration successful, redirecting in progress.'
    ];
}

public function getLeadIdFromTelegram($telegramId){
    try {
        $response = Http::timeout(10)
            ->get("https://api.traffhunt.com/api/public/bots/22/leads/telegram/" . urlencode($telegramId));

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['success']) && !empty($data['data']['id'])) {
                return $data['data']['id'];
            }
        }
    } catch (\Throwable $e) {
        // Логируем ошибку, но НЕ выбрасываем исключение
        \Log::error('Ошибка при получении Lead ID: ' . $e->getMessage());
    }

    // Если что-то пошло не так — возвращаем null
    return null;
}


public function sendPostback(array $data)
{
    $baseUrl = 'https://api.traffhunt.com/api/postback/registration';

    // Список поддерживаемых параметров
    $allowedParams = [
        'lead_id' => 'external_id',
        'platform_id' => 'id',
        'event_id' => 'event_id',
        'offer_id' => 'offer_id',
        'email' => 'email',
        'phone' => 'phone',
        'country_apha2code' => 'country_apha2code',
    ];

    $queryParams = [];

    // Формируем только те параметры, которые реально переданы
    foreach ($allowedParams as $paramName => $dataKey) {
        if (!empty($data[$dataKey])) {
            $queryParams[$paramName] = $data[$dataKey];
        }
    }

    try {
        $response = Http::timeout(10)->get($baseUrl, $queryParams);

        if (!$response->successful()) {
            // Если ответ не успешный, логируем
            Log::error('Ошибка при отправке постбека: Неверный ответ', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
    } catch (\Throwable $e) {
        // Логируем любую ошибку запроса
        Log::error('Ошибка при отправке постбека: ' . $e->getMessage());
    }

    // Функция всегда просто завершает выполнение без ошибки
    return;
}



}
