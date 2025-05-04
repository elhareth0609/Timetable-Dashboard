@extends('layouts.app')
@php
    $isNavbar = false;
    $isSidebar = false;
    $isFooter = false;
@endphp
@section('title', __('Page Not Found'))

@section('content')
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="{{ route('home') }}">&larr; Back to Dashboard</a>
        </div>

        <style>
            .error{color:#5a5c69;font-size:7rem;position:relative;line-height:1;width:12.5rem}
            .error:after{content:attr(data-text);position:absolute;left:2px;text-shadow:-1px 0 #e74a3b;top:0;color:#5a5c69;background:#f8f9fc;overflow:hidden;clip:rect(0,900px,0,0);animation:noise-anim 2s infinite linear alternate-reverse}@-webkit-keyframes noise-anim-2{0%{clip:rect(16px,9999px,10px,0)}5%{clip:rect(22px,9999px,29px,0)}10%{clip:rect(6px,9999px,68px,0)}15%{clip:rect(85px,9999px,95px,0)}20%{clip:rect(65px,9999px,91px,0)}25%{clip:rect(93px,9999px,68px,0)}30%{clip:rect(10px,9999px,27px,0)}35%{clip:rect(37px,9999px,25px,0)}40%{clip:rect(12px,9999px,23px,0)}45%{clip:rect(40px,9999px,18px,0)}50%{clip:rect(19px,9999px,71px,0)}55%{clip:rect(2px,9999px,35px,0)}60%{clip:rect(16px,9999px,69px,0)}65%{clip:rect(8px,9999px,65px,0)}70%{clip:rect(30px,9999px,57px,0)}75%{clip:rect(14px,9999px,4px,0)}80%{clip:rect(39px,9999px,30px,0)}85%{clip:rect(22px,9999px,35px,0)}90%{clip:rect(58px,9999px,71px,0)}95%{clip:rect(34px,9999px,90px,0)}100%{clip:rect(67px,9999px,68px,0)}}@keyframes noise-anim-2{0%{clip:rect(16px,9999px,10px,0)}5%{clip:rect(22px,9999px,29px,0)}10%{clip:rect(6px,9999px,68px,0)}15%{clip:rect(85px,9999px,95px,0)}20%{clip:rect(65px,9999px,91px,0)}25%{clip:rect(93px,9999px,68px,0)}30%{clip:rect(10px,9999px,27px,0)}35%{clip:rect(37px,9999px,25px,0)}40%{clip:rect(12px,9999px,23px,0)}45%{clip:rect(40px,9999px,18px,0)}50%{clip:rect(19px,9999px,71px,0)}55%{clip:rect(2px,9999px,35px,0)}60%{clip:rect(16px,9999px,69px,0)}65%{clip:rect(8px,9999px,65px,0)}70%{clip:rect(30px,9999px,57px,0)}75%{clip:rect(14px,9999px,4px,0)}80%{clip:rect(39px,9999px,30px,0)}85%{clip:rect(22px,9999px,35px,0)}90%{clip:rect(58px,9999px,71px,0)}95%{clip:rect(34px,9999px,90px,0)}100%{clip:rect(67px,9999px,68px,0)}}
            .error:before{content:attr(data-text);position:absolute;left:-2px;text-shadow:1px 0 #4e73df;top:0;color:#5a5c69;background:#f8f9fc;overflow:hidden;clip:rect(0,900px,0,0);animation:noise-anim-2 3s infinite linear alternate-reverse}
        </style>
@endSection