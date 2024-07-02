<?php
$string = "cfb00kr50w254mmc3in3r/p"; // Example string (with separator)

//$pattern = "/(?P<key>\w{2,4})=(?P<value>[\w\d\-]+(?:mm|in)?)|"(P<single_value>\w+\/[^\"]*)"/";
// Use named captures for better readability

preg_match_all($pattern, $string, $matches, PREG_SET_NAME);

// Build the resulting array
$data = [];
foreach ($matches['key'] as $index => $key) {
  if (!empty($key)) {
    $data[$key] = $matches['value'][$index];
  } else {
    $data[] = $matches['single_value'][$index];
  }
}

// Resulting array string
$array_string = json_encode($data);

echo $array_string;

// Regular expression to capture key-value pairs (using backreferences)
//$pattern = "/(\w{2,4})=([\w\d\-]+(?:mm|in)?)|(\w{2,8})/";
// $pattern = "/(?<!\")(\w{2,4})(?!\")([\w\d\-]+(?:mm|in)?)|(?<!\")(\w+)(?!\")/";

// preg_match_all($pattern, $string, $matches);

// // Build the resulting array
// $data = [];
// $count = count($matches[0]); // Get the number of matches

// for ($i = 0; $i < $count; $i++) {
//   if (!empty($matches[1][$i])) {
//     $data[$matches[1][$i]] = $matches[2][$i];
//   } else {
//     $data[] = $matches[3][$i]; // Handle single value without key
//   }
// }

// // Resulting array string
// $array_string = json_encode($data);

// echo $array_string;

//------------------------------------------------------------
// $string = "cfb00kr50w254mmc3in3r/p"; // Example string (with separator)

// $pattern = "/(\w{2,4})=([\w\d\-]+(?:mm|in)?)|(\w{2,8})/";

// preg_match_all($pattern, $string, $matches);

// $data = [];
// $count = count($matches[0]);

// for ($i = 0; $i < $count; $i++) {
//   // Check if a key was captured (optional)
//   if (!empty($matches[1][$i])) {
//     $key = $matches[1][$i];
//     $value = $matches[2][$i];
//   } else {
//     // Handle single value
//     $value = $matches[3][$i];
//     // You can create a default key or handle single values differently
//   }
  
//   // Add key-value pair or single value to the data array
//   $data[$key] = $value;
// }

// // Resulting array string
// $array_string = json_encode($data);

// echo $array_string;
?>