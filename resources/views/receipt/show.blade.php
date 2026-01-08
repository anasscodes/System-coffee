<x-app-layout>

    <h2>🧾 Receipt</h2>

<p>Order #: {{ $order->id }}</p>
<p>Total: {{ $order->total }} DH</p>

<hr>

<h3>⭐ Rate us</h3>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('receipt.feedback', $order->receipt_token) }}">
    @csrf

    {{-- <select name="rating" required>
        <option value="">Choose rating</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select> --}}

    <div class="stars">
    @for($i = 5; $i >= 1; $i--)
        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
        <label for="star{{ $i }}">★</label>
    @endfor
</div>

<style>
.stars {
    display: flex;
    justify-content: center;
    gap: 6px;
    font-size: 30px;
}

.stars input {
    display: none;
}

.stars label {
    cursor: pointer;
    color: #d1d5db;
}

.stars input:checked ~ label,
.stars label:hover,
.stars label:hover ~ label {
    color: #facc15;
}
</style>



    <br><br>

    <textarea name="comment" placeholder="Your comment (optional)"></textarea>

    <br><br>

    <button type="submit">Send</button>
</form>


</x-app-layout>   