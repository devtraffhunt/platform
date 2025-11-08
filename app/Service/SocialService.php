<?php 

namespace App\Service;
use App\User;
use App\Authorization;
use Request;
use Illuminate\Support\Facades\Hash;

class SocialService{
	
	public function saveSocialData($socialUser, $socialBaseUrl, $type)
    {
        $social_id = $socialUser->getId();
        $email = $socialUser->getEmail();
        $name = $socialUser->getName();
        $avatar = $socialUser->getAvatar() ?? 'https://ustanovkaos.ru/wp-content/uploads/2022/02/06-psevdo-pustaya-ava.jpg';

        $social = $socialBaseUrl . $social_id;
        $ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];
        $ref = 0;
        $ref_id = session('ref_id');

        if ($ref_id > 0) {
            $ref = $ref_id;
        }

        $vk_id = null;
        $tg_id = null;

        if ($type == 'vk') {
            $vk_id = $social_id;
        }

        if ($type == 'tg') {
            $tg_id = $social_id;
        }

        // Получение telegram_id из куки
        $telegramId = $_COOKIE['telegram_id'] ?? null;
        $external_id = null;

        if (!empty($telegramId)) {
            $external_id = $this->getLeadIdFromTelegram($telegramId);
        }

        $user = User::where('social_id', $social_id)->first();
        if ($user) {
            return $user;
        }

        if ($ref > 0) {
            $refUser = User::where('id', $ref_id)->first();
            if ($refUser) {
                $refUser->increment('refs');
                $refUser->increment('bonus_refs');
            }
        }

        return User::create([
            'ref_id' => $ref,
            'ip' => $ip,
            'email' => $email,
            'social_id' => $social_id,
            'name' => $name,
            'avatar' => $avatar,
            'social' => $social,
            'vk_id' => $vk_id,
            'tg_id' => $tg_id,
            'external_id' => $external_id,
        ]);
    }

    public function getLeadIdFromTelegram($telegramId)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.traffhunt.com/api/public/bots/15/leads/telegram/" . urlencode($telegramId),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                curl_close($curl);
                return null;
            }

            curl_close($curl);

            $data = json_decode($response, true);

            if (!empty($data['success']) && !empty($data['data']['id'])) {
                return $data['data']['id'];
            }
        } catch (\Throwable $e) {
            // Просто игнорируем ошибки, не ломаем процесс
        }

        return null;
    }
}
?>