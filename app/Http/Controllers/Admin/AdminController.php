<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateHotelRequest;
use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use Upload_image;
    public function index()
    {
        $total_hotels = Hotel::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalBookings = Booking::count();
        $total_rooms = Apartment::where('status', 1)->count();
        $totalRevenue = Booking::sum('price');
        $totalRevenueThisMonth = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price');

        $totalRevenueThisYear = Booking::whereYear('created_at', now()->year)
            ->sum('price');

        $totalRevenueThisWeek = Booking::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->sum('price');


        return view('admin.admin_dashboard', compact(
            'total_hotels',
            'total_rooms',
            'totalUsers',
            'totalBookings',
            'totalRevenue',
            'totalRevenueThisMonth',
            'totalRevenueThisYear',
            'totalRevenueThisWeek'
        )); 
    }
}
