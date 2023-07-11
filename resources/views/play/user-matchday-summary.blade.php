<div class="col-12 col-md-10 mt-2">
    <div class="table-responsive mt-2">
        <table class="table bg-dark-blue text-white ">
            <thead>
                <tr class="bg-secondary text-black">
                    <th> Pagada </th>
                    <th> Participante </th>
                    <th class="text-center" colspan="{{ $round->games()->count() }}">
                        Pronósticos
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($round->userMatchdays as $userMatchday)
                    <tr>
                        <td> {{ $userMatchday->is_paid }} </td>
                        <td> {{Auth::user()->name}} </td>
                        @foreach($userMatchday->userMatches as $userMatch)
                            <td> {{ $userMatch->prediction}} </td>
                        @endforeach
                    </tr>
                @endforeach
                <tr class="bg-secondary text-black">
                    <td colspan="{{ $round->games()->count() + 2 }}">
                        Por pagar: ${{ $round->price * $round->userMatchdays()->where('paid', 0)->count() }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>