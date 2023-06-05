<?php
$childName = $childGender = $teacherName = $absenceReason = $excuse = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$childName = $_POST["childName"];
	$childGender = $_POST["childGender"];
	$teacherName = $_POST["teacherName"];
	$absenceReason = $_POST["absenceReason"];

	$excuses = [
		"maladie" => [
			"Mon enfant est malade et ne peut pas assister aux cours aujourd'hui.",
			"Mon enfant souffre d'une forte fièvre et doit rester au repos.",
			"Mon enfant a attrapé une gastro-entérite et doit se reposer à la maison.",
			"Mon enfant est sous traitement médical et ne peut pas venir à l'école.",
			"Mon enfant est en convalescence suite à une intervention chirurgicale."
		],
		"décès" => [
			"Malheureusement, notre famille a perdu un membre bien-aimé et mon enfant est affecté par cette triste nouvelle.",
			"Notre animal de compagnie est décédé, ce qui a profondément attristé mon enfant.",
			"Un membre proche de notre famille est décédé et mon enfant a besoin de soutien pendant cette période difficile.",
			"Nous avons eu un décès dans notre famille et mon enfant est bouleversé par cette perte.",
			"Mon enfant est en deuil suite au décès d'un proche."
		],
		"activité" => [
			"Mon enfant participe à une compétition sportive importante et ne pourra pas être présent en classe aujourd'hui.",
			"Mon enfant a une représentation théâtrale et doit répéter toute la journée.",
			"Mon enfant est invité à participer à une conférence scientifique et ne pourra pas être présent à l'école.",
			"Mon enfant fait partie d'une équipe de débat et doit se rendre à une compétition.",
			"Mon enfant a une répétition pour le spectacle de danse et doit être présent toute la journée."
		],
		"autre" => [
			"Mon enfant a un rendez-vous médical important et ne pourra pas être à l'école.",
			"Nous avons une urgence familiale et mon enfant doit rester à la maison.",
			"Mon enfant a une journée de rendez-vous chez différents spécialistes.",
			"Mon enfant doit se rendre à un événement familial hors de la ville.",
			"Nous avons une situation imprévue qui nécessite la présence de mon enfant à la maison."
		]
	];

	if (array_key_exists($absenceReason, $excuses)) {
		$excuse = $excuses[$absenceReason][array_rand($excuses[$absenceReason])];
	}
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label for="childName">Nom de l'enfant:</label>
	<input type="text" id="childName" name="childName" required>

	<label for="childGender">Sexe de l'enfant:</label>
	<input type="radio" id="childGender" name="childGender" value="garçon" required> Garçon
	<input type="radio" id="childGender" name="childGender" value="fille" required> Fille

	<label for="teacherName">Nom du professeur:</label>
	<input type="text" id="teacherName" name="teacherName" required>

	<label>Motif d'absence:</label>
	<input type="radio" id="absenceReason" name="absenceReason" value="maladie" required> Maladie
	<input type="radio" id="absenceReason" name="absenceReason" value="décès" required> Décès de l'animal (ou d'un membre de la famille)
	<input type="radio" id="absenceReason" name="absenceReason" value="activité" required> Activité parascolaire importante
	<input type="radio" id="absenceReason" name="absenceReason" value="autre" required> Autre

	<button type="submit">Générer l'excuse</button>
</form>

<?php if ($excuse) : ?>
	<div class="excuse">
		<p>Cher(e) professeur <?php echo $teacherName; ?>,</p>
		<p>Je vous informe par la présente que mon enfant <?php echo $childName; ?> ne pourra pas assister aux cours aujourd'hui en raison de :</p>
		<p><?php echo $excuse; ?></p>
		<p>Je vous remercie de votre compréhension.</p>
		<p>Cordialement,</p>
		<p>Signature parent</p>
	</div>
<?php endif; ?>
