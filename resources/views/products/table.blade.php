<table class="table table-responsive" id="products-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Companyid</th>
        <th>Price</th>
        <th>Fabric</th>
        <th>Least</th>
        <th>Colors</th>
        <th>Images</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{!! $product->name !!}</td>
            <td>{!! $product->image !!}</td>
            <td>{!! $product->description !!}</td>
            <td>{!! $product->companyid !!}</td>
            <td>{!! $product->price !!}</td>
            <td>{!! $product->fabric !!}</td>
            <td>{!! $product->least !!}</td>
            <td>{!! $product->colors !!}</td>
            <td>{!! $product->images !!}</td>
            <td>
                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('products.show', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('products.edit', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>