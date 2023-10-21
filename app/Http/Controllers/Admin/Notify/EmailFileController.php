<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;

class EmailFileController extends Controller
{
    public function index(Email $email)
    {
        // dd(EmailFile::all());
        return view('admin.notify.email_file.index', compact('email'));
    }
}
