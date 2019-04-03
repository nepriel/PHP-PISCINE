SELECT floor_number AS 'floor', SUM(nb_seats) AS 'seats' from cinema GROUP BY floor_number ORDER BY sum(nb_seats) DESC;
