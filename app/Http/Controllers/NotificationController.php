<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NotifikasiModel;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = NotifikasiModel::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($notifications);
    }
}
