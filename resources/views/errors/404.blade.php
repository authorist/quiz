@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', $exception->getMessage()) 
<!--  @section('message', __('Not Found'))        hata meşajlarına kendi meşajımızı akliyecegiz aynı kodu alıyoruz aşagıya               -->

 <!-- hata exceptiona düşüyor getmessage ile meşajımızı yazdırdık -->
