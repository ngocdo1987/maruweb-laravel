@component('mail::message')
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach
■■━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br/><br/>

一般社団法人リファイニング建築・都市再生協会<br/><br/>

《 住所 》〒1500012 東京都渋谷区広尾5丁目9-9-201<br/>
《 Mail 》jimukyoku@refining.or.jp<br/>
《 TEL 》03-6825-7488<br/>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━■■
@endcomponent
