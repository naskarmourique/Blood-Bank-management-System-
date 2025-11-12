-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'mourique', 'izya', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blood_inventory`
--

CREATE TABLE `blood_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(10) NOT NULL,
  `available_units` int(11) NOT NULL,
  `previous_available_units` int(11) DEFAULT 0,
  `status` varchar(20) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_inventory`
--

INSERT INTO `blood_inventory` (`id`, `blood_group`, `available_units`, `previous_available_units`, `status`, `expiry_date`) VALUES
(1, 'A+', 120, 100, 'Available', '2026-01-15'),
(2, 'A-', 80, 75, 'Low Stock', '2025-12-01'),
(3, 'B+', 90, 85, 'Low Stock', '2026-02-20'),
(4, 'B-', 40, 50, 'Critical', '2025-11-20'),
(5, 'AB+', 60, 55, 'Low Stock', '2026-03-10'),
(6, 'AB-', 30, 40, 'Critical', '2025-11-25'),
(7, 'O+', 150, 140, 'Available', '2026-01-30'),
(8, 'O-', 100, 90, 'Low Stock', '2025-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `blood_events`
--

CREATE TABLE `blood_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `target_donors` int(11) DEFAULT 0,
  `registered_donors` int(11) DEFAULT 0,
  `donated_units` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `contact_person` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_events`
--

INSERT INTO `blood_events` (`id`, `event_name`, `event_type`, `description`, `location`, `event_date`, `start_time`, `end_time`, `organizer`, `target_donors`, `registered_donors`, `donated_units`, `status`, `contact_person`) VALUES
(1, 'Mega Blood Drive - Delhi', 'Community Drive', 'Join us for the largest blood donation camp in Delhi. Help us save lives together!', 'India Gate, New Delhi', '2025-11-15', '09:00:00', '17:00:00', 'AIIMS Delhi & Red Cross Society', 250, 127, 0, 'approved', 'Dr. Sharma'),
(2, 'University Blood Donation', 'University Drive', 'Annual blood drive at the university campus.', 'IIT Mumbai Campus', '2025-11-18', '10:00:00', '16:00:00', 'IIT Mumbai Student Council', 150, 89, 0, 'approved', 'Prof. Rao'),
(3, 'City Hospital Drive', 'Hospital Drive', 'Support our local hospital with much-needed blood donations.', 'City General Hospital, Bangalore', '2025-11-25', '09:30:00', '16:30:00', 'City General Hospital', 100, 45, 0, 'approved', 'Nurse Priya'),
(4, 'Tech Park Blood Drive', 'Corporate Drive', 'Blood donation camp for employees at Cyberhub.', 'Cyberhub, Gurgaon', '2025-11-12', '11:00:00', '17:00:00', 'Tech Solutions Inc.', 120, 60, 0, 'approved', 'Mr. Gupta'),
(5, 'Community Health Fair', 'Community Drive', 'Part of our annual health fair, focusing on blood donation.', 'Community Center, Pune', '2025-11-20', '08:00:00', '14:00:00', 'Pune Health Association', 80, 30, 0, 'approved', 'Ms. Desai'),
(6, 'Kolkata Charity Drive', 'Community Drive', 'A charity event to collect blood for thalassemia patients.', 'Netaji Indoor Stadium, Kolkata', '2025-10-10', '10:00:00', '18:00:00', 'Kolkata Foundation', 200, 150, 140, 'completed', 'Mr. Banerjee'),
(7, 'Chennai Blood Camp', 'Hospital Drive', 'Blood donation camp at Apollo Hospital, Chennai.', 'Apollo Hospital, Chennai', '2025-10-25', '09:00:00', '17:00:00', 'Apollo Hospitals', 150, 120, 110, 'completed', 'Dr. Reddy'),
(8, 'Hyderabad Tech Drive', 'Corporate Drive', 'Annual blood drive at Hitech City.', 'Hitech City, Hyderabad', '2025-11-10', '10:00:00', '18:00:00', 'Hitech City Association', 300, 250, 0, 'approved', 'Mr. Rao'),
(9, 'Jaipur Winter Drive', 'Community Drive', 'Winter blood donation drive to help with seasonal shortages.', 'Albert Hall Museum, Jaipur', '2025-12-05', '11:00:00', '17:00:00', 'Jaipur Youth Club', 100, 50, 0, 'approved', 'Ms. Singh'),
(10, 'Mumbai Monsoon Drive', 'Community Drive', 'Blood donation drive during the monsoon season.', 'Marine Drive, Mumbai', '2025-11-10', '09:00:00', '16:00:00', 'Mumbai Red Cross', 200, 180, 0, 'approved', 'Mr. Khan');

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

CREATE TABLE `blood_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) NOT NULL,
  `BLOOD_GROUP` varchar(10) NOT NULL,
  `UNITS` int(11) NOT NULL,
  `HOSPITAL_NAME` varchar(255) NOT NULL,
  `HOSPITAL_LOCATION` varchar(255) NOT NULL,
  `MOB` varchar(20) NOT NULL,
  `REQUIRED_DATE` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`id`, `patient_name`, `BLOOD_GROUP`, `UNITS`, `HOSPITAL_NAME`, `HOSPITAL_LOCATION`, `MOB`, `REQUIRED_DATE`) VALUES
(1, 'Rohan Sharma', 'A+', 2, 'Apollo Hospital', 'Delhi', '9876543210', '2025-11-12'),
(2, 'Priya Singh', 'O-', 1, 'Fortis Hospital', 'Mumbai', '9876543211', '2025-11-15'),
(3, 'Amit Patel', 'B+', 3, 'Max Hospital', 'Bangalore', '9876543212', '2025-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `F_NAME` varchar(255) NOT NULL,
  `L_NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `MOBILE` varchar(20) NOT NULL,
  `SUBJECT` varchar(255) NOT NULL,
  `MESSAGE` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `F_NAME`, `L_NAME`, `EMAIL`, `MOBILE`, `SUBJECT`, `MESSAGE`) VALUES
(1, 'Anjali', 'Verma', 'anjali.verma@example.com', '9988776655', 'Inquiry about blood donation', 'I would like to know the process for donating blood.'),
(2, 'Rahul', 'Kumar', 'rahul.kumar@example.com', '9988776656', 'Feedback on website', 'The website is very user-friendly and informative.');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FULL_NAME` varchar(255) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `BLOOD_GROUP` varchar(10) NOT NULL,
  `STATE` varchar(100) NOT NULL,
  `CITY` varchar(100) NOT NULL,
  `MOB` varchar(20) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `S_QUESTION` varchar(255) NOT NULL,
  `S_ANSWER` varchar(255) NOT NULL,
  `LAST_DONATE` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `FULL_NAME`, `TYPE`, `BLOOD_GROUP`, `STATE`, `CITY`, `MOB`, `EMAIL`, `PASSWORD`, `S_QUESTION`, `S_ANSWER`, `LAST_DONATE`) VALUES
(1, 'Sunita Williams', 'Donor', 'O+', 'Gujarat', 'Ahmedabad', '9876543210', 'sunita.w@example.com', 'password123', 'What is your mother''s maiden name?', 'Sharma', '2025-05-10'),
(2, 'Vikram Singh', 'Donor', 'A+', 'Delhi', 'New Delhi', '9876543211', 'vikram.s@example.com', 'password123', 'What is your favorite color?', 'Blue', '2025-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `RATING` int(11) NOT NULL,
  `FEEDBACK` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `NAME`, `TYPE`, `RATING`, `FEEDBACK`) VALUES
(1, 'Aarav Sharma', 'Donor', 5, 'Great experience donating blood. The staff was very helpful.'),
(2, 'Sneha Reddy', 'Recipient', 4, 'Thank you for helping me find a blood donor in time.');

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `blood_inventory` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
ALTER TABLE `blood_events` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `blood_request` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `contact_us` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `donor` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `feedback` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
