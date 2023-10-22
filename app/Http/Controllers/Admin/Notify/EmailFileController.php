<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;

class EmailFileController extends Controller
{
    public function index(Email $email)
    {
        // dd(EmailFile::all());
        return view('admin.notify.email_file.index', compact('email'));
    }

    public  function create(Email $email)
    {
        return view('admin.notify.email_file.create', compact('email'));
    }

    public function store(EmailFileRequest $request, Email $email, FileSer)
    {
        dd($request);
    }
}
