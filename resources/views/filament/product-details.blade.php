<div>
    <h1> <i>{{ $product->Name }} Details</i></h1>
    <p><strong>Price:</strong> €{{ $product->Price }}</p>
    <p><strong>Brand:</strong> {{ $product->brand->Name }}</p>
    <p><strong>Category:</strong> {{ $product->category->Name }}</p>
    <br>

    @if ($product->detail)
        <h1><i>Additional Specifications:</i></h1>

        @switch($product->category->Name)
            @case('PC')
                <p><strong>CPU:</strong> {{ $product->detail->data['cpu'] ?? 'N/A' }}</p>
                <p><strong>RAM:</strong> {{ $product->detail->data['ram'] ?? 'N/A' }}</p>
                <p><strong>Storage:</strong> {{ $product->detail->data['storage'] ?? 'N/A' }}</p>
                <p><strong>GPU:</strong> {{ $product->detail->data['gpu'] ?? 'N/A' }}</p>
                <p><strong>Motherboard:</strong> {{ $product->detail->data['motherboard'] ?? 'N/A' }}</p>
                <p><strong>Power Supply:</strong> {{ $product->detail->data['power_supply'] ?? 'N/A' }}</p>
                @break
            @case('Phone')
                <p><strong>Operating System:</strong> {{ $product->detail->data['os'] ?? 'N/A' }}</p>
                <p><strong>Camera:</strong> {{ $product->detail->data['camera'] ?? 'N/A' }}</p>
                <p><strong>Battery:</strong> {{ $product->detail->data['battery'] ?? 'N/A' }}</p>
                @break
            @case('NIC')
                <p><strong>Network Type:</strong> {{ $product->detail->data['network_type'] ?? 'N/A' }}</p>
                @break
            @case('Keyboard')
                <p><strong>Form Factor:</strong> {{ $product->detail->data['form_factor'] ?? 'N/A' }}</p>
                @break
            @case('Monitor')
                <p><strong>Resolution:</strong> {{ $product->detail->data['resolution'] ?? 'N/A' }}</p>
                @break
            @case('Laptop')
                <p><strong>Screen Size:</strong> {{ $product->detail->data['screen_size'] ?? 'N/A' }}</p>
                <p><strong>RAM:</strong> {{ $product->detail->data['ram'] ?? 'N/A' }}</p>
                <p><strong>Storage:</strong> {{ $product->detail->data['storage'] ?? 'N/A' }}</p>
                @break
            @case('Tablet')
                <p><strong>Screen Size:</strong> {{ $product->detail->data['screen_size'] ?? 'N/A' }}</p>
                <p><strong>Battery Capacity:</strong> {{ $product->detail->data['battery_capacity'] ?? 'N/A' }}</p>
                @break
            @case('Smartwatch')
                <p><strong>Weight:</strong> {{ $product->detail->data['weight'] ?? 'N/A' }}</p>
                @break
            @case('Router')
                <p><strong>Ports:</strong> {{ $product->detail->data['ports'] ?? 'N/A' }}</p>
                @break
            @case('Headphones')
                <p><strong>Impedance:</strong> {{ $product->detail->data['impedance'] ?? 'N/A' }}</p>
                @break
            @case('Speakers')
                <p><strong>Power Rating:</strong> {{ $product->detail->data['power_rating'] ?? 'N/A' }}</p>
                @break
            @case('Mouse')
                <p><strong>DPI:</strong> {{ $product->detail->data['dpi'] ?? 'N/A' }}</p>
                @break
            @case('Printer')
                <p><strong>Print Speed:</strong> {{ $product->detail->data['print_speed'] ?? 'N/A' }}</p>
                @break
            @case('Camera')
                <p><strong>Lens:</strong> {{ $product->detail->data['lens'] ?? 'N/A' }}</p>
                @break
            @case('Charger')
                <p><strong>Voltage:</strong> {{ $product->detail->data['voltage'] ?? 'N/A' }}</p>
                @break
            @case('Power Bank')
                <p><strong>Capacity:</strong> {{ $product->detail->data['capacity'] ?? 'N/A' }}</p>
                @break
            @case('Graphics Card')
                <p><strong>Memory:</strong> {{ $product->detail->data['memory'] ?? 'N/A' }}</p>
                @break
            @case('Motherboard')
                <p><strong>Form Factor:</strong> {{ $product->detail->data['form_factor'] ?? 'N/A' }}</p>
                @break
            @case('SSD')
                <p><strong>Read Speed:</strong> {{ $product->detail->data['read_speed'] ?? 'N/A' }}</p>
                @break
            @case('HDD')
                <p><strong>Write Speed:</strong> {{ $product->detail->data['write_speed'] ?? 'N/A' }}</p>
                @break
            @default
                <p>No additional details available for this product.</p>
        @endswitch
    @else
        <p>No additional details available for this product.</p>
    @endif
</div>
