Norėdami pakeisti slaptažodį, spauskite šią nuorodą: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
