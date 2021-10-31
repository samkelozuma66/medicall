<?php
session_start();
 

class Booking
{
    public $DATABASE_HOST = 'localhost';
    public $DATABASE_USER = 'pinecott_medicall';
    public $DATABASE_PASS = 'Medicall@123';
    public $DATABASE_NAME = 'pinecott_medicallzn';
    
    // Try and connect using the info above.
    public $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    private $dbh;
 
    private $bookingsTableName = 'medic_bookings';
 
    /**
     * Booking constructor.
     * @param string $database
     * @param string $host
     * @param string $databaseUsername
     * @param string $databaseUserPassword
     */
    public function __construct($DATABASE_NAME, $DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS)
    {
        try {
 
            $this->con =
                new PDO(sprintf( $DATABASE_HOST, $DATABASE_NAME),
                    $DATABASE_USER,
                    $DATABASE_PASS
                );
 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
 
    public function index()
    {
        $statement = $this->con->query('SELECT * FROM ' . $this->medic_bookings);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function add(DateTimeImmutable $_date)
    {
        $statement = $this->dbh->prepare(
            'INSERT INTO ' . $this->medic_bookings . ' (_date) VALUES (:_date)'//,' (_time) VALUES (:_time)'
        );
 
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
 
        if (false === $statement->execute([
                ':_date' => $_date->format('Y-m-d'),
            ])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }
 
    public function delete($booking_number)
    {
        $statement = $this->con->prepare(
            'DELETE from ' . $this->medic_bookings . ' WHERE id = :booking_number'
        );
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
        if (false === $statement->execute([':booking_number' => $booking_number])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }
 
}