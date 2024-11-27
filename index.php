<?php
session_start();
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    setcookie('theme', $theme, time() + (86400 * 30), "/"); // 86400 = 1 day
}
// Ievads, ko vēlaties parādīt
$introduction = "Ziemassvētku laiks ir brīdis, kad īpaši izjūtam mīlestības, rūpju un dāvināšanas nozīmi. Mājdzīvnieki - mūsu uzticamākie draugi - sniedz mums beznosacījumu mīlestību, bet daudzi no tiem cieš no pamestības un vientulības. Šajos svētkos aicinām ikvienu atcerēties arī par tiem, kuri mūs uztver kā visu savu pasauli! Parūpēsimies, lai neviens dzīvnieks nepaliek novārtā, un kopā radīsim pasauli, kurā mīlestība un rūpes tiek ikkatram, arī četrkājainajiem ģimenes locekļiem.";

// Teksti un ikonas
$sections = [
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circles-relation"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.183 6.117a6 6 0 1 0 4.511 3.986" /><path d="M14.813 17.883a6 6 0 1 0 -4.496 -3.954" /></svg>',
        'title' => 'Saikne un uzticība',
        'text' => 'Dzīvnieki sniedz beznosacījumu mīlestību un uzticību, un tas ir mūsu pienākums šo uzticību nesagraut.'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home-infinity"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 14v-2h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h2.5" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 1.75 1.032" /><path d="M15.536 17.586a2.123 2.123 0 0 0 -2.929 0a1.951 1.951 0 0 0 0 2.828c.809 .781 2.12 .781 2.929 0c.809 -.781 -.805 .778 0 0l1.46 -1.41l1.46 -1.419" /><path d="M15.54 17.582l1.46 1.42l1.46 1.41c.809 .78 -.805 -.779 0 0s2.12 .781 2.929 0a1.951 1.951 0 0 0 0 -2.828a2.123 2.123 0 0 0 -2.929 0" /></svg>',
        'title' => 'Atbildība',
        'text' => 'Mājdzīvnieks ir ģimenes loceklis, kas ir pilnībā atkarīgs no sava saimnieka.'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none "/><path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" /></svg>',
        'title' => 'Veselība un drošība',
        'text' => 'Pamesti dzīvnieki ir pakļauti bada, slimību un plēsēju uzbrukumiem, kas apdraud viņu dzīvību.'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-world"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M3.6 9h16.8" /><path d="M3.6 15h16.8" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" /></svg>',
        'title' => 'Ietekme uz sabiedrību',
        'text' => 'Pamesti mājdzīvnieki bieži kļūst par klaiņojošiem dzīvniekiem, radot sabiedrības drošības riskus.'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" /><path d="M12.5 15.5l2 2" /><path d="M15 13l2 2" /></svg>',
        'title' => 'Morālās vērtības',
        'text' => 'Rūpes par mājdzīvnieku atspoguļo mūsu cilvēcību un empātiju pret dzīvo radību.'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-scale"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 20l10 0" /><path d="M6 6l6 -1l6 1" /><path d="M12 3l0 17" /><path d="M9 12l-3 - 6l-3 6a3 3 0 0 0 6 0" /><path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0" /></svg>',
        'title' => 'Likums',
        'text' => 'Dzīvnieku atstāšana novārtā ir likuma pārkāpums.'
    ],
];

// Jaunais jautājumu un atbilžu saraksts
$accordionQuestions = [
    [
        'question' => 'Ko apsvērt, pirms mājdzīvnieka iegādes?',
        'answer' => 'Rūpes par dzīvnieku ir ilgtermiņa. Piemēram, suņi un kaķi dzīvo 10 - 20 gadus. Mājdzīvniekam nepieciešama ikdienas uzmanība. Ko iesāksiet, ja dosieties ceļojumā? Ir nepieciešamas finanses barošanai. Turklāt arī mājdzīvnieki mēdz saslimt, un tiem nav bezmaksas veselības aprūpe.'
    ],
    [
        'question' => 'Ko iesākt, ja tomēr nevarat vairs parūpēties?',
        'answer' => 'Atcerieties, ka dzīvnieks nav lieta, bet gan dzīva radība! Vēlams censties atrast jaunas, mīlošas mājas pie cilvēkiem, kurus pazīstat. Konsultējaties ar dzīvnieku patversmēm. Nākošos saimniekus vai patversmi informējiet par patieso dzīvnieka veselības stāvokli.'
    ],
    [
        'question' => 'Kā rīkoties, ja pamanat pamestu mājdzīvnieku?',
        'answer' => 'Pārliecinieties par situāciju - dažkārt saimnieks ir tālāk nekā vajadzētu būt. Par prioritāti ņemot savu drošību, mēģiniet dzīvnieku piesaukt un noskaidrot, vai ir kāda norāde par īpašnieku (piemēram, piekariņš pie kaklasiksnas). Ja dzīvnieks labprātīgi nenāk pie Jums, necentieties to ķert un piespiest! Sazinieties ar tuvāko patversmi vai zvaniet policijai uz 112.'
    ]
];
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Ziemassvētku Laiks</title>

   
    <style>
        body.dark {
    background-color: #333;
    color: #fff;
}
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            font-size: 1.2em;
            line-height: 1.5;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .box {
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }
        .icon {
            font-size: 2em;
        }
        .title {
            font-weight: bold;
            margin: 10px 0;
        }
        .accordion {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 20px;
        }
        .accordion-item {
            border-bottom: 1px solid #ccc;
        }
        .accordion-header {
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            background-color: #f1f1f1;
        }
        .accordion-body {
            padding: 10px;
            display: none;
        }
    </style>
    <script>
        function toggleAccordion(event) {
            const body = event.currentTarget.nextElementSibling;
            body.style.display = body.style.display === 'block' ? 'none' : 'block';
        }
       
}
    </script>
</head>
<body class="<?php echo $theme; ?>">
    <h1>Ziemassvētku laiks</h1>
    <p><?php echo $introduction; ?></p>
    <div class="theme-toggle">
        <form method="POST">
            <label for="theme-switch">Izvēlieties tēmu:</label>
            <select id="theme-switch" name="theme" onchange="this.form.submit()">
                <option value="light" <?php if ($theme == 'light') echo 'selected'; ?>>Gaišs</option>
                <option value="dark" <?php if ($theme == 'dark') echo 'selected'; ?>>Tumšs</option>
            </select>
        </form>
    </div>
    <div class="container">
        <?php foreach ($sections as $section): ?>
            <div class="box">
                <div class="icon"><?php echo $section['icon']; ?></div>
                <div class="title"><?php echo $section['title']; ?></div>
                <p><?php echo $section['text']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="accordion">
        <?php foreach ($accordionQuestions as $item): ?>
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(event)">
                    <?php echo $item['question']; ?>
                </div>
                <div class="accordion-body">
                    <p><?php echo $item['answer']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="gg.html" class="cool-button">SPĒLĒT PUZZLI</a>
    
</body>
</html>