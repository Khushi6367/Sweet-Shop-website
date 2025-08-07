<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invoice #{{ $billno }}</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      margin: 20px;
      background-color: #fff;
    }

    .container {
      max-width: 900px;
      margin: auto;
      padding: 40px;
    }

    h1, h3, h4 {
      color: maroon;
      margin-bottom: 8px;
    }

    p {
      margin: 4px 0;
      line-height: 1.5;
    }

    .info-section {
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      margin-bottom: 30px;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px 8px;
      text-align: left;
      font-size: 14px;
    }

    th {
      color: #fff;
      background-color: maroon;
      font-weight: normal;
    }

    tr:not(:last-child) td {
      border-bottom: 1px solid #eee;
    }

    .total-row td {
      font-weight: bold;
      padding-top: 12px;
    }

    .signatory {
      text-align: right;
      margin-top: 40px;
      font-size: 14px;
      font-weight: bold;
    }

    .footer {
      text-align: center;
      font-size: 13px;
      color: #555;
      margin-top: 40px;
    }

    .terms {
      font-size: 12px;
      color: #555;
      margin-top: 40px;
      width: 50%;
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px 15px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tbody tr {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
      }

      td {
        position: relative;
        padding-left: 50%;
        text-align: right;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        font-weight: bold;
        text-align: left;
      }

      .terms {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>{{ $company['name'] }}</h1>
      <p>{{ $company['address'] }}</p>
      <p>GSTIN: {{ $company['gstin'] }}</p>
      <p>FSSAI: {{ $company['fssai'] }}</p>
      <p>Email: {{ $company['email'] }}</p>
      <p>Phone: {{ $company['phone'] }}</p>
      <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;" />
      <h3>Invoice #{{ $billno }}</h3>
    </header>

    <section class="info-section">
      <h4>Shipping & Billing Information</h4>
      <p><strong>Name:</strong> {{ $userInfo['name'] }}</p>
      <p><strong>Mobile:</strong> {{ $userInfo['mobile'] }}</p>
      <p><strong>Address:</strong> {{ $userInfo['address'] }}</p>
    </section>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Product</th>
          <th>Flavour</th>
          <th>Weight</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $index => $item)
          <tr>
            <td data-label="#"> {{ $index + 1 }} </td>
            <td data-label="Product"> {{ $item->product_name }} </td>
            <td data-label="Flavour"> {{ $item->flavour }} </td>
            <td data-label="Weight"> {{ $item->weight }} {{ $item->weight_type }} </td>
            <td data-label="Qty"> {{ $item->qty }} </td>
            <td data-label="Price"> {{ number_format($item->price, 2) }} </td>
            <td data-label="Total"> {{ number_format($item->finalprice, 2) }} </td>
          </tr>
        @endforeach
        <tr class="total-row">
          <td colspan="6" style="text-align:right;">Grand Total:</td>
          <td>{{ number_format($total, 2) }}</td>
        </tr>
      </tbody>
    </table>

    <div class="signatory">
      <p>For {{ $company['name'] }}</p>
      <p>Authorised Signatory</p>
    </div>

    <div class="terms">
      <h4>Terms & Conditions</h4>
      <ul style="padding-left: 20px; margin-top: 10px;">
        <li>Subject to jurisdiction of our location.</li>
        <li>Please check goods at the time of delivery.</li>
        <li><strong>E. & O. E.</strong> (Errors and Omissions Excepted)</li>
      </ul>
    </div>

    <div class="footer">
      <p>Thank you for choosing {{ $company['name'] }}!</p>
    </div>
  </div>
</body>
</html>
