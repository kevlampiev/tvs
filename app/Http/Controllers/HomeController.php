<?php

namespace App\Http\Controllers;


use App\DataServices\User\DashboardDataservice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('User.dashboard', DashboardDataservice::provideData());
    }

    public function readNotification(Request $request): RedirectResponse
    {
        $id = $request->route('id');
        $notification = auth()->user()->notifications->where('id', $id)->first();
        if (!$notification) {
            session()->flash('error', 'Вы пытаетесь прочесть чужое уведомление');
            return redirect()->back();
        }
        $notification->markAsRead();
        return redirect()->to($notification->data['link']);
    }

    public function markAllNotificationsAsRead(Request $request): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();
        session()->flash('message', 'Все уведомления для Вас помечены как прочитанные');
        return redirect()->back();
    }
}
