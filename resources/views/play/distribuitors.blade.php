<div class="col-12 mt-2">
    <div class="table-responsive mt-2">
        <table class="table bg-dark-blue text-white ">
            <thead>
                <tr class="text-white">
                    <th> Lugar/Nombre </th>
                    <th> Domicilio </th>
                    <th> Municipio </th>
                </tr>
            </thead>
            <tbody>
                @foreach($distribuitors as $distribuitor)
                    <tr>
                        <td> {{ $distribuitor->name }} </td>
                        <td> {{ $distribuitor->address }} </td>
                        <td> {{ $distribuitor->city . ',' . $distribuitor->state }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>