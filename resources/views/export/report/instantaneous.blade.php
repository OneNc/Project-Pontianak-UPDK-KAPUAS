<table>
    <tr>
        <td colspan="26"><strong>Report Instantaneous</strong></td>
    </tr>
    <tr>
        <td>Meter Group</td>
        <td colspan="25">: {{ $info->group->name }}</td>
    </tr>
    <tr>
        <td>Meter Name</td>
        <td colspan="25">: {{ $info->name }}</td>
    </tr>
    <tr>
        <td>Export</td>
        <td colspan="25">: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
    </tr>
    <tr>
        <td>Range</td>
        <td colspan="25">: {{ $info->start->format('Y-m-d H:i:s') }} to {{ $info->end->format('Y-m-d H:i:s') }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>

    <tr>
        <th>Datetime</th>
        <th>Voltage R</th>
        <th>Voltage S</th>
        <th>Voltage T</th>
        <th>Ampere R</th>
        <th>Ampere S</th>
        <th>Ampere T</th>
        <th>Cosphi</th>
        <th>Frequency</th>
        <th>Power Active</th>
        <th>Power Reactive</th>
        <th>Power Apparent</th>
        <th>Export Energy Rate1</th>
        <th>Export Energy Rate2</th>
        <th>Export Energy Total</th>
        <th>Import Energy Rate1</th>
        <th>Import Energy Rate2</th>
        <th>Import Energy Total</th>
        <th>Kvar Energy Export</th>
        <th>Kvar Energy Import</th>
        <th>Phasor Vr</th>
        <th>Phasor Ir</th>
        <th>Phasor Vs</th>
        <th>Phasor Is</th>
        <th>Phasor Vt</th>
        <th>Phasor It</th>
    </tr>

    @foreach ($data as $instant)
        <tr>
            <td class="w-100">{{ $instant->created_at->format('Y-m-d H:i:s') }}</td>
            <td class="w-100">{{ $instant->voltage_r }}</td>
            <td class="w-100">{{ $instant->voltage_s }}</td>
            <td class="w-100">{{ $instant->voltage_t }}</td>
            <td class="w-100">{{ $instant->current_r }}</td>
            <td class="w-100">{{ $instant->current_s }}</td>
            <td class="w-100">{{ $instant->current_t }}</td>
            <td class="w-100">{{ $instant->cosphi }}</td>
            <td class="w-100">{{ $instant->frequency }}</td>
            <td class="w-100">{{ $instant->power_active_import }}</td>
            <td class="w-100">{{ $instant->power_reactive_import }}</td>
            <td class="w-100">{{ $instant->power_apparent_import }}</td>
            <td class="w-100">{{ $instant->export_energy_rate1 }}</td>
            <td class="w-100">{{ $instant->export_energy_rate2 }}</td>
            <td class="w-100">{{ $instant->export_energy_total }}</td>
            <td class="w-100">{{ $instant->import_energy_rate1 }}</td>
            <td class="w-100">{{ $instant->import_energy_rate2 }}</td>
            <td class="w-100">{{ $instant->import_energy_total }}</td>
            <td class="w-100">{{ $instant->kvar_energy_export }}</td>
            <td class="w-100">{{ $instant->kvar_energy_import }}</td>
            <td class="w-100">{{ $instant->phasor_vr }}</td>
            <td class="w-100">{{ $instant->phasor_ir }}</td>
            <td class="w-100">{{ $instant->phasor_vs }}</td>
            <td class="w-100">{{ $instant->phasor_is }}</td>
            <td class="w-100">{{ $instant->phasor_vt }}</td>
            <td class="w-100">{{ $instant->phasor_it }}</td>
        </tr>
    @endforeach
</table>
