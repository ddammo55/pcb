<table class="ui twelve column celled table">
    <thead>
      <tr>
        <th>ID</th>
        <th>시리얼번호</th>
        <th>보드명</th>
        <th>생산일</th>
        <th>출하일</th>
        <th>출하내역</th>
        <th>불량</th>
        <th>불량내용</th>
        <th>타입</th>
        <th>인수자</th>
        <th>인계자</th>
        <th>메모</th>
      </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>

        <td>
          <form action="/serialNameSearch" method="GET">
            <input type="hidden" name="serial_name" value="{{ $product->serial_name }}" >
            <button style=" background:none;border:none; margin:0px;cursor: pointer;">{{ $product->serial_name }}</button>
          </form>
        </td>

        <td>
          <form action="/pbas/" method="GET">
            <input type="hidden" name="board_name" value="{{ $product->board_name }}" >
            <button style=" background:none;border:none; margin:0px;cursor: pointer;">{{ $product->board_name }}</button>
          </form>
        </td>

        <td>{{ $product->product_date }}</td>
        <td>{{ $product->shipment }}</td>
        <td>{{ $product->shipment_daily }}</td>
        <td>{{ $product->faulty }}</td>
        <td>{{ $product->remarks }}</td>
        <td>{{ $product->type }}</td>
        <td>{{ $product->receiver }}</td>
        <td>{{ $product->ship_user }}</td>
        <td>{{ $product->note }}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
