<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
            @foreach($titles as $title => $field)
                <th scope="col">{{$title}}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($collection as $record)
            <tr>
                @foreach($titles as $fieldName)
                <th>{{$record[$fieldName]}}</th>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>
                    {{$collection->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
</div>