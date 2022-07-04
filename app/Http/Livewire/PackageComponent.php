<?php

namespace App\Http\Livewire;

use App\Models\Packages;
use App\Models\Subscription;
use App\Models\User;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PackageComponent extends Component
{
    public function render()
    {
        return view('livewire.package-component', [
            'packages' => Packages::all(),
            'subscription' => auth()->user()->subscription,
        ]);
    }

    public function subscribePlan(Packages $package)
    {
        $user = User::findOrFail(Auth::id());
        $startdate = new DateTime('now', new DateTimeZone('Asia/Yangon'));
        $expiredate = new DateTime('now', new DateTimeZone('Asia/Yangon'));
        $expiredate->add(new DateInterval('P'.$package->duration.'D'));
        Subscription::updateOrCreate(
            [
                'user_id' =>  $user->id,
            ], [
                'packages_id' => $package->id,
                'started_date' => $startdate,
                'expire_date' => $expiredate,
                'expired' => false,
            ]
            );
        $user->coin += $package->amount;
        $user->save();
        $this->emit('PlanSubscribed');
    }
}
