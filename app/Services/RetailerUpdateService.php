<?php
namespace App\Services;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RetailerUpdateService {

    /**
     * Update the specified resource in storage.
     *
     * @param $request
     * @param $retailer
     * @return RedirectResponse
     */
    public function update($request, $retailer): RedirectResponse
    {
        $information = $request->validated();

        // For super admin
        if ( Auth::user()->role == 'superadmin' )
        {
            $retailer->update( $information );

            Alert::success('Success', 'Retailer information updated successfully.');

            return to_route('retailer.index');
        }


        // For others user
        if ( $retailer->name != Str::title( $request->name ) )
        {
            unset( $information['name'] );
            $information['tmp_name'] = $request->name;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->type != Str::upper( $request->type ) )
        {
            unset( $information['type'] );
            $information['tmp_type'] = $request->type;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->owner_name != Str::title( $request->owner_name ) )
        {
            unset( $information['owner_name'] );
            $information['tmp_owner_name'] = $request->owner_name;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->contact_no != $request->contact_no )
        {
            unset( $information['contact_no'] );
            $information['tmp_contact_no'] = $request->contact_no;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->nid != $request->nid )
        {
            unset( $information['nid'] );
            $information['tmp_nid'] = $request->nid;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->address != Str::title( $request->address ) )
        {
            unset( $information['address'] );
            $information['tmp_address'] = $request->address;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->trade_license_no != $request->trade_license_no )
        {
            unset( $information['trade_license_no'] );
            $information['tmp_trade_license_no'] = $request->trade_license_no;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->latitude != $request->latitude )
        {
            unset( $information['latitude'] );
            $information['tmp_latitude'] = $request->latitude;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->longitude != $request->longitude )
        {
            unset( $information['longitude'] );
            $information['tmp_longitude'] = $request->longitude;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->device_name != Str::title( $request->device_name ) )
        {
            unset( $information['device_name'] );
            $information['tmp_device_name'] = $request->device_name;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->device_sn != $request->device_sn )
        {
            unset( $information['device_sn'] );
            $information['tmp_device_sn'] = $request->device_sn;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        if ( $retailer->scanner_sn != $request->scanner_sn )
        {
            unset( $information['scanner_sn'] );
            $information['tmp_scanner_sn'] = $request->scanner_sn;

            if ($retailer->status != 'unapproved')
            {
                $information['status'] = 'unapproved';
            }
        }

        $retailer->update( $information );

//        $superAdmin = User::firstWhere('role', 'super-admin');
//        $rso = Rso::firstWhere( 'user_id', Auth::id());
//
//        $superAdmin->notify( new RetailerUpdateNotification( $retailer, $rso ) );
//        Notification::sendNow( $superAdmin,  );

        return to_route('Retailer update request sent successfully.');
    }
}
