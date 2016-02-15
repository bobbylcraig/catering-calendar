# Denison Enterprises - Piper Project
A project integrating scheduling and catering for student use.
Objective: minimize food waste and provide service to Denison students.

Piper Project Pseudocode and Notes
===================================================

Left List
===================================================

<ul>

<?php

foreach “event” {
	$counter = 0;
	<li> Event Info Here </li>
	foreach “person” {
		$counter = $counter + 1;
		<ul>
		if people.foreign_key == event.event_id {
			<li> Event Occupied [SQL.time_occupied>] </li>
		}
	}
	for (int i = $counter; i <= [SQL.max_attendants]; i++ ) {
		<li> Open Spot </li>
	}
	</ul>
}

?>

</ul>

Insert Event Code
===================================================

- Upload the .ics file.
- Parse the .ics file
- Form Fields for notes and attendees
- [Modal that has info and warning?]
- Submit to database

Sign-Up Code
===================================================

- AutoFill date selection form
- RegEx check for @denison.edu email
- Email Verification - verify.php with hash

Database Structure
===================================================

- TABLE ‘EVENT’
    - EVENT_ID (PRIMARY KEY)
    - DATE
    - START_TIME
    - END_TIME
    - FOOD_TYPE
    - LOCATION
    - NOTES
    - ATTENDANCE_LIMIT
- TABLE ‘PEOPLE”
    - PERSON_ID (PRIMARY KEY)
    - EVENT_ID (FOREIGN KEY)
    - D_NUMBER
    - EMAIL
    - FNAME
    - LNAME
    - CLASS_YEAR
