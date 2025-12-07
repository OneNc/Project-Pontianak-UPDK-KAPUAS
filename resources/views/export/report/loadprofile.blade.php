<table>
    <tr>
        <td colspan="14"><strong>Report Load Profile</strong></td>
    </tr>
    <tr>
        <td>Meter Group</td>
        <td colspan="13">: {{ $info->group->name }}</td>
    </tr>
    <tr>
        <td>Meter Name</td>
        <td colspan="13">: {{ $info->name }}</td>
    </tr>
    <tr>
        <td>Export</td>
        <td colspan="13">: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
    </tr>
    <tr>
        <td>Range</td>
        <td colspan="13">: {{ $info->start->format('Y-m-d H:i:s') }} to {{ $info->end->format('Y-m-d H:i:s') }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>

    <tr>
        <th>Datetime</th>
        <th>Record</th>
        <th>Export Wh Total</th>
        <th>Export varh Total</th>
        <th>Import Wh Total</th>
        <th>Import varh Total</th>
        <th>Avg Voltage Ph-A</th>
        <th>Avg Voltage Ph-B</th>
        <th>Avg Voltage Ph-C</th>
        <th>Avg Current Ph-A</th>
        <th>Avg Current Ph-B</th>
        <th>Avg Current Ph-C</th>
        <th>Avg Power Factor Total</th>
        <th>Avg Frequency</th>
        <th>Avg Watts Total</th>
        <th>Avg var Total</th>
    </tr>

    @foreach ($data as $profile)
        <tr>
            <td class="w-100">{{ $profile->created_at->format('Y-m-d H:i:s') }}</td>
            <td class="w-100">{{ $profile->record }}</td>
            <td class="w-100">{{ $profile->export_wh_total }}</td>
            <td class="w-100">{{ $profile->import_wh_total }}</td>
            <td class="w-100">{{ $profile->export_varh_total }}</td>
            <td class="w-100">{{ $profile->import_varh_total }}</td>
            <td class="w-100">{{ $profile->avg_voltage_r }}</td>
            <td class="w-100">{{ $profile->avg_voltage_s }}</td>
            <td class="w-100">{{ $profile->avg_voltage_t }}</td>
            <td class="w-100">{{ $profile->avg_current_r }}</td>
            <td class="w-100">{{ $profile->avg_current_s }}</td>
            <td class="w-100">{{ $profile->avg_current_t }}</td>
            <td class="w-100">{{ $profile->avg_power_factor_total }}</td>
            <td class="w-100">{{ $profile->avg_frequency }}</td>
            <td class="w-100">{{ $profile->avg_watts_total }}</td>
            <td class="w-100">{{ $profile->avg_var_total }}</td>
        </tr>
    @endforeach
</table>
