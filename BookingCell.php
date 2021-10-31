<?php
 
 
class BookableCell
{
    /**
     * @var Booking
     */
    private $booking;
 
    private $currentURL;
 
    /**
     * BookableCell constructor.
     * @param $booking
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->currentURL = htmlentities($_SERVER['REQUEST_URI']);
    }
 
    public function update(Calendar $cal)
    {
        if ($this->isDateBooked($cal->getCurrentDate())) {
            return $cal->cellContent =
                $this->bookedCell($cal->getCurrentDate());
        }
 
        if (!$this->isDateBooked($cal->getCurrentDate())) {
            return $cal->cellContent =
                $this->openCell($cal->getCurrentDate());
        }
    }
 
    public function routeActions()
    {
        if (isset($_POST['delete'])) {
            $this->deleteBooking($_POST['booking_number']);
        }
 
        if (isset($_POST['add'])) {
            $this->addBooking($_POST['_date']);
        }
    }
 
    private function openCell($_date)
    {
        return '<div class="open">' . $this->bookingForm($_date) . '</div>';
    }
 
    private function bookedCell($_date)
    {
        return '<div class="booked">' . $this->deleteForm($this->bookingId($_date)) . '</div>';
    }
 
    private function isDateBooked($date)
    {
        return in_array($date, $this->bookedDates());
    }
 
    private function bookedDates()
    {
        return array_map(function ($record) {
            return $record['booking_date'];
        }, $this->booking->index());
    }
 
    private function bookingId($date)
    {
        $booking = array_filter($this->booking->index(), function ($record) use ($_date) {
            return $record['_date'] == $_date;
        });
 
        $result = array_shift($booking);
 
        return $result['booking_number'];
    }
 
    private function deleteBooking($booking_number)
    {
        $this->booking->delete($booking_number);
    }
 
    private function addBooking($_date)
    {
        $date = new DateTimeImmutable($_date);
        $this->booking->add($_date);
    }
 
    private function bookingForm($_date)
    {
        return
            '<form  method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="add" />' .
            '<input type="hidden" name="date" value="' . $_date . '" />' .
            '<input class="submit" type="submit" value="Book" />' .
            '</form>';
    }
 
    private function deleteForm($booking_number)
    {
        return
            '<form onsubmit="return confirm(\'Are you sure to cancel?\');" method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="delete" />' .
            '<input type="hidden" name="id" value="' . $booking_number . '" />' .
            '<input class="submit" type="submit" value="Delete" />' .
            '</form>';
    }
}