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
        <th>Import Wh</th>
        <th>Export Wh</th>
        <th>Import VArh</th>
        <th>Export VArh</th>
        <th>Voltage R</th>
        <th>Voltage S</th>
        <th>Voltage T</th>
        <th>Ampere R</th>
        <th>Ampere S</th>
        <th>Ampere T</th>
        <th>Cosphi</th>
    </tr>

    @foreach ($data as $profile)
        <tr>
            <td class="w-100">{{ $profile->created_at->format('Y-m-d H:i:s') }}</td>
            <td class="w-100">{{ $profile->record }}</td>
            <td class="w-100">{{ $profile->import_wh }}</td>
            <td class="w-100">{{ $profile->export_wh }}</td>
            <td class="w-100">{{ $profile->import_varh }}</td>
            <td class="w-100">{{ $profile->export_varh }}</td>
            <td class="w-100">{{ $profile->avg_voltage_r }}</td>
            <td class="w-100">{{ $profile->avg_voltage_s }}</td>
            <td class="w-100">{{ $profile->avg_voltage_t }}</td>
            <td class="w-100">{{ $profile->avg_current_r }}</td>
            <td class="w-100">{{ $profile->avg_current_s }}</td>
            <td class="w-100">{{ $profile->avg_current_t }}</td>
            <td class="w-100">{{ $profile->cosphi }}</td>
        </tr>
    @endforeach
</table>
