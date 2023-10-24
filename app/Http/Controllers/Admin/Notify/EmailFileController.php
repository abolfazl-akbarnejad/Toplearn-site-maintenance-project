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

    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();

        if ($request->hasFile('file')) {
            //Defining the path where the file is to be uploaded
            $fileService->setExclusiveDirectory('files'  . DIRECTORY_SEPARATOR . 'email_file');

            //Definition of the sent file to get the size of that file
            $fileService->setFileSize($request->file('file'));
            //The obtained value of the file size is placed in a variable to be used when uploading to the database
            $fileSize = $fileService->getFileSize();

            //Moves the sent file to the specified path
            $resultUploadFiel =  $fileService->moveToPublic($request->file('file'));

            //Get the file format to store the value in the database to display to the user
            //*** To get the file format, the previous step must be done ***//
            $formatFile = $fileService->getFileFormat();
        }

        $inputs['public_mali_id'] = $email->id;
        $inputs['file_path'] = $resultUploadFiel;
        $inputs['file_size'] = $fileSize;
        $inputs['file_type'] = $formatFile;

        if ($resultUploadFiel) {
            $result = EmailFile::create($inputs);

            if ($result) {
                return redirect()->route('admin.notify.email_file.index', $email->id)->with('success', " آپلود فایل شما با موفقیت انجام شد");
            } else {
                return redirect()->route('admin.notify.email_file.index', $email->id)->with('error', " آپلود فایل شما با خطا مواجه شد");
            }
        } else {
            return redirect()->route('admin.notify.email_file.index', $email->id)->with('error', " آپلود فایل شما با خطا مواجه شد");
        }
    }

    public function edit($id)
    {
        $emailfile = EmailFile::findOrFail($id);

        $email = $emailfile->email;
        return view('admin.notify.email_file.edit', compact('emailfile', 'email'));
    }

    public function update(Request $request, $id, FileService $fileService)
    {
        $emailfile = EmailFile::findOrFail($id);
        $email = $emailfile->email;

        $inputs = $request->all();

        if ($request->hasFile('file')) {
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR  . 'email_file');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            $resultFile = $fileService->moveToPublic($request->file('file'));
            $fileType = $fileService->getFileFormat();
            $delete = $fileService->deleteFile($emailfile->file_path);
        }


        $inputs['file_path'] = $resultFile;
        $inputs['file_size'] = $fileSize;
        $inputs['file_type'] = $fileType;

        $result = $emailfile->update($inputs);
        if ($result) {
            return redirect()->route('admin.notify.email_file.index', $email->id)->with('success', " ویرایش فایل شما با موفقیت انجام شد");
        } else {
            return redirect()->route('admin.notify.email_file.index', $email->id)->with('error', " ویرایش فایل شما با خطا مواجه شد");
        }
    }

    public function destroy($id)
    {

        $emailfile = EmailFile::findOrFail($id);
        $email = $emailfile->email;

        $result = $emailfile->delete();

        if ($result) {
            return redirect()->route('admin.notify.email_file.index', $email->id)->with('success', "  فایل شما با موفقیت حذف  شد");
        } else {
            return redirect()->route('admin.notify.email_file.index', $email->id)->with('error', " حذف فایل شما با خطا مواجه شد");
        }
    }

    public function status($id)
    {
        $emailfile = EmailFile::findOrFail($id);


        $emailfile->status = $emailfile->status == 0 ? 1 : 0;
        $result = $emailfile->save();
        if ($result) {
            if ($emailfile->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
