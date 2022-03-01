@extends('layouts.myapp')
@section('title','市場取引ルール')
@section('content')
  <div class="area">
    <input type="radio" name="tab_name" id="tab1" checked>
    <label class="tab_class" for="tab1">米国株式市場</label>
    <div class="content_class">
    <p>米国株式市場のルール</p>
    <p>アメリカの証券取引所の取引時間は、米国東部時間の9時30分～16時に統一されています。<br>日本とアメリカ東部との時差は通常14時間、サマータイムのときは13時間なので、日本時間では以下のようになります。</p>
    <table>
        <tr>
        <th></th>
        <th>米国株式市場取引時間</th>
        <th>米国株式市場取引停止時間</th>
        </tr>
        <tr>
        <td>米国サマータイム（夏時間）</td>
        <td>月曜 午前7時00分～土曜 午前5時55分</td>
        <td>午前5時55分～午前6時10分</td>
        </tr>
        <tr>
        <td>米国標準時間（冬時間）</td>
        <td>月曜 午前7時00分～土曜 午前6時55分</td>
        <td>午前6時55分～午前7時10分</td>
        </tr>
    </table>
<p>＜通常＞</p>
<p>日本時間：23時30分～翌6時</p>

<p>＜サマータイム＞</p>
<p>日本時間：22時30分～翌5時</p>
<p>※サマータイムは3月第2日曜日から11月第1日曜日まで。</p>

<p>市場取引に加えて現地時間の8時～9時30分と16時～20時には時間外取引
（ExtendedHoursTrading）が行われます。<br>そのため、日本でアメリカ株を取引できるのは標準時間期間の場合で22時～翌10時（サマータイムで21時～翌9時）の12時間になります。</p>
<p>時間外取引は、ブローカー同士の私設市場であるECN（電子証券取引ネットワーク）で行われます。通常取引と比べて売買価格の開きが大きくなったり、価格の変動が激しかったりするため、<br>取引前にリスクに関する同意書を提出することになっています。</p>
    </div>
    <input type="radio" name="tab_name" id="tab2" >
    <label class="tab_class" for="tab2">タブ2</label>
    <div class="content_class">
      <p>タブ2のコンテンツを表示します</p>
    </div>
    <input type="radio" name="tab_name" id="tab3" >
    <label class="tab_class" for="tab3">タブ3</label>
    <div class="content_class">
      <p>タブ3のコンテンツを表示します</p>
    </div>
    <input type="radio" name="tab_name" id="tab4" >
    <label class="tab_class" for="tab4">タブ4</label>
    <div class="content_class">
      <p>タブ4のコンテンツを表示します</p>
    </div>
    <input type="radio" name="tab_name" id="tab5" >
    <label class="tab_class" for="tab5">タブ5</label>
    <div class="content_class">
      <p>タブ5のコンテンツを表示します</p>
    </div>
  </div>
@endsection