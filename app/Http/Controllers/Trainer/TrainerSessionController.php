<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerSessionStoreRequest;
use App\Http\Requests\TrainerSessionUpdateRequest;
use App\Models\Member\Member;
use App\Models\Staff\PersonalTrainer;
use App\Models\Trainer\Trainer;
use App\Models\Trainer\TrainerPackage;
use App\Models\Trainer\TrainerSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerSessionController extends Controller
{
    public function index()
    {
        $data = [
            'title'             => 'Trainer Session List',
            'trainerSession'    => TrainerSession::get(),
            'members'           => Member::get(),
            // 'personalTrainers'  => Trainer::get(),
            'personalTrainers'  => PersonalTrainer::get(),
            'trainerPackages'   => TrainerPackage::get(),
            'content'           => 'admin/trainer-session/index'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title'             => 'New Trainer Session',
            'trainerSession'    => TrainerSession::all(),
            'members'           => Member::get(),
            // 'trainers'          => Trainer::get(),
            'personalTrainers'  => PersonalTrainer::get(),
            'trainerPackages'   => TrainerPackage::get(),
            'users'             => User::get(),
            'content'           => 'admin/trainer-session/create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function store(TrainerSessionStoreRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        TrainerSession::create($data);
        return redirect()->route('trainer-session.index')->with('message', 'Trainer Session Added Successfully');
    }

    public function show($id)
    {
        // $trainerSession        = TrainerSession::with(['members', 'product'])->findOrFail($id);

        $data = [
            'title'             => 'Trainer Session Detail',
            'trainerSession'    => TrainerSession::find($id),
            'members'           => Member::get(),
            // 'trainers'          => Trainer::get(),
            'personalTrainers'  => PersonalTrainer::get(),
            'trainerPackages'   => TrainerPackage::get(),
            'content'           => 'admin/trainer-session/show',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function edit(string $id)
    {
        $data = [
            'title'             => 'Edit Trainer Session',
            'trainerSession'    => TrainerSession::find($id),
            'members'           => Member::get(),
            // 'trainers'          => Trainer::get(),
            'personalTrainers'  => PersonalTrainer::get(),
            'trainerPackages'   => TrainerPackage::get(),
            'content'           => 'admin/trainer-session/edit'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function update(TrainerSessionUpdateRequest $request, string $id)
    {
        $item = TrainerSession::find($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $item->update($data);
        return redirect()->route('trainer-session.index')->with('message', 'Trainer Session Updated Successfully');
    }

    public function destroy(TrainerSession $trainerSession)
    {
        try {
            $trainerSession->delete();
            return redirect()->back()->with('message', 'Trainer Session Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Deleted Failed, please check other page where using this trainer session');
        }
    }
}
