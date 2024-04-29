<div>
    {{-- In work, do what you enjoy. --}}

    <table>
    <tr>
        <th>Name</th>
    </tr>
    @foreach ($data as $item)
       <tr>
        <td>
            {{$item->posts_name}}
        </td>
       </tr>
    @endforeach
</table>

<style>
    table,tr,td,th{
        border: 1px solid black;
        width: 20%;
    }
    td{
        text-align: center;
    }
</style>
</div>
