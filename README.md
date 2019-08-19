# netgsm-api

        $sendMessage = $netgsm->sms
        ->numbers(['05000000000'])
        ->messages('Lorem İpsum Dolor Sit Amet')
        ->send();
        
        var_dump($sendMessage);