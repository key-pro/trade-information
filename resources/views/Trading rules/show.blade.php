@extends('layouts.myapp')
@section('title','市場取引ルール')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="area">
          <input type="radio" name="tab_name" id="tab1" checked>
          <label class="tab_class" for="tab1">米国株式市場</label>
          <div class="content_class">
          @csrf
            <p>米国株式市場のルール</p>
            <p>アメリカの証券取引所の取引時間は、米国東部時間の9時30分～16時に統一されています。<br>日本とアメリカ東部との時差は通常14時間、サマータイムのときは13時間なので、日本時間では以下のようになります。</p>
            <div>
              <div>
                <h3>米国サマータイム（夏時間）</h3>
                <h4>米国株式市場取引時間</h4>
                <p>月曜 午前7時00分～土曜 午前5時55分</p>
                <h4>米国株式市場取引停止時間</h4>
                <p>午前5時55分～午前6時10分</p>
              </div>
              <div>
                <h3>米国標準時間（冬時間）</h3>
                <h4>米国株式市場取引時間</h4>
                <p>月曜 午前7時00分～土曜 午前6時55分</p>
                <h4>米国株式市場取引停止時間</h4>
                <p>午前6時55分～午前7時10分</p>
              </div>
            </div>
            <h3>＜通常＞</h3>
            <p>日本時間：23時30分～翌6時</p>

            <h3>＜サマータイム＞</h3>
            <p>日本時間：22時30分～翌5時</p>
            <p>※サマータイムは3月第2日曜日から11月第1日曜日まで。</p>

            <p>市場取引に加えて現地時間の8時～9時30分と16時～20時には時間外取引
              （ExtendedHoursTrading）が行われます。<br>そのため、日本でアメリカ株を取引できるのは標準時間期間の場合で22時～翌10時（サマータイムで21時～翌9時）の12時間になります。</p>
            <p>時間外取引は、ブローカー同士の私設市場であるECN（電子証券取引ネットワーク）で行われます。通常取引と比べて売買価格の開きが大きくなったり、価格の変動が激しかったりするため、取引前にリスクに関する同意書を提出することになっています。</p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <input type="radio" name="tab_name" id="tab2" class="form-check-input">
    <label class="tab_class form-check-label" for="tab2">FX(外国為替取引)<br>ルール1</label>
    <div class="content_class form-check">
      <h3 class="form-check-label">FXの概要</h3>
      <h4 class="form-check-label">FXの基本</h4>
     <p class="form-check-label">日本円を外国の通貨に換える取引を「外国為替取引」といいます。<br>
      たとえば日本円を米ドルに換えることを「ドル買い」あるいは「円売り」といいます。<br>
      ところが、通貨の価値は刻一刻と変わっていきます。1米ドル＝120円だったり、121円だったりします。<br>
      この価格変動に着目して取引する投資がFXなのです。<br>
      たとえば1米ドル＝110円で買ったとします。これを1米ドル＝120円で売ったとすれば、<br>
      10円の利益が出ます。これを為替差益といい、FXはこの為替差益を狙った取引です。<br>
      取引は日本円や米ドルだけでなく、数多くの通貨の組み合わせで行なえます。</p>
      <h4 class="form-check-label">FXの魅力</h4>
      <p class="form-check-label">FXの魅力はまずなんといっても少額資金でスタートできる点にあります。<br>
      少額の資金で多額の投資資金を動かせるところにFXの魅力があります。<br>
      逆にそこにリスクも潜みます。</p>
      <h4 class="form-check-label">FXの注意点</h4>
      <p class="form-check-label">投じた金額の何倍もの利益が期待できる代わりに、何倍もの損失が出ることもあるわけです。<br>
      株式や投資信託以上に、いかにリスクを抑えるかが大事になります。<br>株式投資の銘柄数や投資信託の商品数はケタ違いに多く、
      投資先の選択にも迷います。</p>
      <h4 class="form-check-label">FXのポイント</h4>
      <p class="form-check-label">FXであれば対象となる外国通貨の数はかなり限られます。<br>
      はじめは、米ドルやユーロだけを対象にしてもよいでしょう。<br>
      FXの場合、株式のように個別企業の情報を追う必要はなく、チャートと経済の大きな流れ（円高か円安かなど）で判断します。<br>
      為替を動かす要因のうち、個人投資家が注目すべきものもわずかです。FXは短期の売買になりやすいので、日々の値動きもチェックしておきましょう。</p>
     <p class="form-check-label">
      FXの場合、株式のように個別企業の情報を追う必要はなく、チャートと経済の大きな流れ（円高か円安かなど）で判断します。為替を動かす要因のうち、個人投資家が注目すべきものもわずかです。FXは短期の売買になりやすいので、日々の値動きもチェックしておきましょう。
      </p>
      <h3 class="form-check-label">FXのメリット</h3>
      <div>
          <div>
          <h4 class="form-check-label">投資資金</h4>
          <h5 class="form-check-label">FX</h5>
          <p class="form-check-label">少額から可能<br>(数万、あるいは数千円でも)</p>
          <h4 class="form-check-label">投資商品</h4>
          <p class="form-check-label">対象通貨100通貨ペア(会社によって異なる)</p>
          </div>
          <div>
          <h4 class="form-check-label">投資資金</h4>
          <h5 class="form-check-label">株式投資</h5>
          <p class="form-check-label">まとまった資金が必要<br>(多くは数十万円単位から)</p>
          <p class="form-check-label">日本の上場企業だけでも3000以上</p>
          </div>
      </div>
      <h3 class="text-danger">fxのデメリット</h3>
      <div class="alert alert-danger">
          <div>
          <h4 class="text-danger">投資資金</h4>
          <h4 class="text-danger">FX</h4>
          <p class="text-danger">ゼロになることも珍しくない</p>
          <p class="text-danger">常にチェックしておきたい</p>
          </div>
          <div>
          <h4 class="text-danger">株式投資</h4>
          <p class="text-danger">ゼロになるケースは、めったにない</p>
          <p class="text-danger">必ずしも頻繁にチェックしなくてよい</p>
          </div>
      </div>
      <h5 class="text-danger">少ない資金で大きな運用</h5>
     <p class="text-danger">FX取引を行なうには専用の取引業者や証券会社などに口座を開設します。<br>
      取引にあたっては、先にお金を担保として預け入れます。<br>
      これを「証拠金」といいます。FXが単なる外貨預金と異なるのは、FXは預けた資金の何倍もの通貨を買い付けられるのです。</p>
     <p class="text-danger">通貨は、米ドルなら120円の水準から1円（1％未満）値動きしただけでも大きな変動といえます。<br>
        ただし、１円（1％）の値動きでは投資の妙味がありません。<br>そこでFXでは、預けた資金の何倍もの金額（通貨）を動かすことができるのです。<br>
        このシステムをレバレッジといいます。50万円の証拠金で500万円の取引を行なう場合「レバレッジが10倍」といいます。<br>レバレッージが大きいほど、損益の幅が大きくなります。</p>
    </div>
    <input type="radio" name="tab_name" id="tab3" >
    <label class="tab_class" for="tab3">FX(外国為替取引)<br>ルール2</label>
    <div class="content_class">
      <h3 class="text-danger">いつでもできる24時間取引</h3>
     <p class="text-danger">外国為替は、たとえば株式取引における証券取引所のような取引所はありません。<br>
        世界各地にある銀行間での為替は取引されています。そのためFXは、月曜の朝から金曜の深夜（土曜の早朝）まで、平日であれば24時間取引ができるようになっています。</p>
     <p class="text-danger">日中にしか取引できない株式投資と違って、平日の日中は時間が取れないサラリーマンでも、夜帰宅してから取引ができます。<br>
        とくに欧米の銀行が開くのは日本時間では夜中。そのため主要通貨である米ドルやユーロは日本の夜に取引が活発になります。</p>
     <p class="text-danger">自分のライフスタイルに合わせて、好きな時間に取引ができます。</p>
      <h3 class="text-danger">金利差で利息を得る</h3>
     <p class="text-danger">外貨預金とは、より金利の高い外国の通貨で預金することでインカムゲイン（利息）を狙うものです。<br>FXでもこの利息がつきます。これは低金利の通貨を売って、高金利の通貨を買った場合、その金利差の分だけ受け取ることができるのです。</p>
     <p class="text-danger">日本は稀有の低金利となっています。日本円を売って高金利の通貨を買えば、その金利差分の利息を受け取れます。<br>レバレッージを利かせられるので、けっして金利も無視できません。この「2つの通貨の金利差」をスワップといいます。</p>
     <p class="text-danger">ただし高金利の通貨を売って、低金利の通貨を買ったときは、逆に金利差分を支払わなければなりません。<br>このケースではインカムゲインとキャピタルゲイン（売買益）を天秤にかけて判断しましょう。</p>
    </div>
    <input type="radio" name="tab_name" id="tab4" >
    <label class="tab_class" for="tab4">米国株の銘柄コード</label>
    <div class="content_class">
      <h3 class="text-danger">米国株の銘柄コード（ティッカーシンボル）についてです。</h3>
     <p class="text-danger">米国株では、全ての銘柄にティッカーシンボルというアルファベットが与えられて、銘柄コードが決められています。</p>
     <p class="text-danger">米国株の銘柄コード（ティッカーシンボル）はアルファベットで決まっています。<p class="h1">
     <p class="text-danger">ニューヨーク証券取引所（NYSE）の上場株式は3文字以下</p>
     <p class="text-danger">ナスダック（NASDAQ）上場の株式は4文字または5文字</p>
     <p class="text-danger">となります。</p>
     <p class="text-danger">例えば、コカ・コーラ（KO）の場合はニューヨーク証券取引所、アップル（AAPL）はナスダック上場だということがすぐに分かります。</p>
    </div>
    <input type="radio" name="tab_name" id="tab5" >
    <label class="tab_class" for="tab5">日本株の銘柄コード</label>
    <div class="content_class">
     <p class="text-danger">日本株の銘柄コードについて</p>
      <h3 class="text-danger">銘柄コードとは</h3>
     <p class="text-danger">銘柄コードを気軽に覚えるための2つの豆知識</p>
     <p class="text-danger">銘柄コードは業種ごとに傾向がある（頭2桁）</p>
     <p class="text-danger">最初は頭２桁の特徴です。<br>
        銘柄コードはランダムに付されているわけではなく業種ごとに一定の法則があります。<br>
        それは４桁のうちで頭の２桁は業種のコードを表していると言うものです。<br>
        （ただし最近上場する銘柄に関しては３０００番台あたりでランダムに付されています）<br>
        下記を参考にしてください。</p>
        <table class="meigara_code_jp">
          <tr>
          <th class="column">銘柄コード（先頭2桁）</th>
          <th>業種</th>
          </tr>
          <tr>
            <td>13～</td>
            <td>水産・農林</td>
          </tr>
          <tr>
            <td>14～19</td>
            <td>鉱業・建設</td>
          </tr>
          <tr>
            <td>20～</td>
            <td>食品・サービス・小売り</td>
          </tr>
          <tr>
            <td>34～35</td>
            <td>卸売・小売り</td>
          </tr>
          <tr>
            <td>36～</td>
            <td>情報通信</td>
          </tr>
          <tr>
            <td>39～</td>
            <td>パルブ・紙</td>
          </tr>
          <tr>
            <td>40～</td>
            <td>化学</td>
          </tr>
          <tr>
            <td>45～</td>
            <td>薬品</td>
          </tr>
          <tr>
            <td>46～</td>
            <td>情報通信</td>
          </tr>
          <tr>
            <td>50～</td>
            <td>ガラス土石</td>
          </tr>
          <tr>
            <td>51～</td>
            <td>ゴム</td>
          </tr>
          <tr>
            <td>52～</td>
            <td>窯業・鉄鋼</td>
          </tr>
          <tr>
            <td>54～</td>
            <td>鉄鋼</td>
          </tr>
          <tr>
            <td>57～</td>
            <td>非鉄</td>
          </tr>
          <tr>
            <td>59～</td>
            <td>金属製品</td>
          </tr>
          <tr>
            <td>60～</td>
            <td>サービス</td>
          </tr>
          <tr>
            <td>61～</td>
            <td>機械</td>
          </tr>
          <tr>
            <td>65～</td>
            <td>電気機器</td>
          </tr>
          <tr>
            <td>70～</td>
            <td>造船・輸送用機器</td>
          </tr>
          <tr>
            <td>71～</td>
            <td>金融（一部）</td>
          </tr>
          <tr>
            <td>72～</td>
            <td>輸送用機器</td>
          </tr>
          <tr>
            <td>72～</td>
            <td>輸送用機器</td>
          </tr>
          <tr>
            <td>74～</td>
            <td>小売り・卸売</td>
          </tr>
          <tr>
            <td>77～</td>
            <td>精密機器</td>
          </tr>
          <tr>
            <td>77～</td>
            <td>精密機器</td>
          </tr>
          <tr>
            <td>79～</td>
            <td>その他製品</td>
          </tr>
          <tr>
            <td>80～</td>
            <td>卸売宇小売り</td>
          </tr>
          <tr>
            <td>83～</td>
            <td>銀行</td>
          </tr>
          <tr>
            <td>86～</td>
            <td>証券</td>
          </tr>
          <tr>
            <td>87～</td>
            <td>保険</td>
          </tr>
          <tr>
            <td>88～</td>
            <td>不動産</td>
          </tr>
          <tr>
            <td>90～</td>
            <td>陸運</td>
          </tr>
          <tr>
            <td>91～</td>
            <td>海運</td>
          </tr>
          <tr>
            <td>93～</td>
            <td>倉庫</td>
          </tr>
          <tr>
            <td>94～</td>
            <td>情報通信</td>
          </tr>
          <tr>
            <td>95～</td>
            <td>電気・ガス</td>
          </tr>
          <tr>
            <td>96～</td>
            <td>卸売・サービス</td>
          </tr>
      </table>
    </div>
  </div>
@endsection