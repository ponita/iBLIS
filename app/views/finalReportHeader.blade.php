@section ("interimReportHeader")
<style type="text/css">
     table {
        padding: 2px;
     }
     TD{font-family: Bookman Old Style; font-size: 9pt; font-variant: normal;}
</style>

    <table style="padding: 0px;" >
        <thead>
            <tr>
                <td colspan="12"></td>
            </tr>
    </table>
    <table style="text-align:center;" >
            <tr>
                <td colspan="12" style="text-align:center;">
                    {{ @HTML::image(Config::get('kblis.organization-logo'),  Config::get('kblis.country') . trans('messages.court-of-arms'), array('width' => '90px')) }}
                </td>
            </tr>
            <tr>               
                <td colspan="12" style="text-align:center;"><b>
                    <span style="font-size:12px">
                        {{ strtoupper(Config::get('constants.FACILITY_NAME')) }}<br>
                    </span>
                    </b>
                     {{Config::get('kblis.final-report-name')}}
                </td>
            </tr>
        </thead>
    </table>
<br>
<table  border="0" width="100%"; style="border-bottom: 1px solid #cecfd5">
    <tr>
        <td width="20%"><b>Patient Name</b></td>
        <td width="30%">{{ $patient->name }}</td>
        <td width="20%"><b>Patient ID</b></td>
        <td width="30%">{{ $patient->ulin }}</td>
    </tr>
    <tr>
        <td width="20%"><b>{{ trans('messages.gender')}} & {{ trans('messages.age')}}</b></td>
        <td width="30%">{{ $patient->getGender(false) }} | {{ $patient->getAge()}}</td>
        <td width="20%"><strong>Patient's Contact</strong>:</td>
        <td width="30%">{{ $patient->phone_number}}</td>
    </tr>
    <tr>
        <td width="20%"><b>Requesting Officer</b></td>
        <td width="30%">@if(isset($tests))
            @if(!empty($tests->first()))
                @if(!empty($tests->first()->requested_by))
                    {{$tests->first()->clinician->name}}
                @endif
            @endif
            @endif
        </td>
        <td width="20%"><b>Officer's Contact</b></td>
        <td width="30%">@if(isset($tests))
                @if(!empty($tests->first()))
                    @if(!empty($tests->first()->therapy->contact))
                        {{$tests->first()->therapy->contact}}
                    @elseif(!empty($tests->first()->clinician->phone))
                        {{$tests->first()->clinician->phone}}
                    @endif
                @endif
            @endif
        </td>
    </tr>       
    <tr>
        <td width="20%"><strong>Facility/Dept</strong>:</td>
        <td width="30%">
        @if(isset($tests))
            @if(!is_null($tests->first()))
            {{ is_null($tests->first()->visit->ward) ? '':$tests->first()->visit->ward->name }}
            @endif
        @endif
        </td>
        <td width="25%"><strong>Patient Facility/Dept ID</strong>:</td>
        <td width="25%">
        
            {{is_null( $patient->patient_number)?'': $patient->patient_number}}    
        </td>
    </tr>
</table>
@show
