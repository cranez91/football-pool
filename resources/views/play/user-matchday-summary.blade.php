<div class="col-12 mt-2">
    <div class="table-responsive mt-2">
        <table class="table bg-dark-blue text-white ">
            <thead>
                <tr class=" text-white">
                    <th> Folio </th>
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
                        <td> {{ $userMatchday->uuid }} </td>
                        <td> {{ $userMatchday->is_paid }} </td>
                        <td> {{Auth::user()->name}} </td>
                        @foreach($userMatchday->userMatches as $userMatch)
                            <td> {{ $userMatch->prediction}} </td>
                        @endforeach
                    </tr>
                @endforeach
                <tr class="text-white">
                    <td colspan="{{ $round->games()->count() + 3 }}">
                        @php 
                            $userMatchdays = $round->userMatchdays()
                                ->where('user_id', Auth::user()->id)
                                ->where('paid', 0)
                                ->count();
                        @endphp
                        <strong class="text-yellow">
                            Por pagar: ${{ $round->price * $userMatchdays }}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>