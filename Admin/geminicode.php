$string = "cfb00kr50w254mmc3in3r/p";

// Define expected key lengths (assuming key lengths are 2 or 4 characters)
$keyLengths = [2, 4];

// Initialize variables
$data = [];
$currentKey = null;

for ($i = 0; $i < strlen($string); $i++) {
  $char = $string[$i];

  // Check if character is alphanumeric or underscore
  if (ctype_alnum($char) || $char === '_') {
    // Try to find a key from expected lengths if current key is not set
    if (is_null($currentKey)) {
      foreach ($keyLengths as $length) {
        if (strlen($string) >= $i + $length && substr($string, $i, $length) === substr($string, $i, $length)) {
          $currentKey = substr($string, $i, $length);
          $i += $length - 1; // Adjust index to skip the key part
          break;
        }
      }
    } else {
      // Append character to the current value
      $data[$currentKey] .= $char;
    }
  } else {
    // Handle potential separators (optional)
    // You can add logic here to reset currentKey or handle specific separators if needed
  }
}

// Convert the data array to JSON string
$json_string = json_encode($data);

// Print the JSON string
echo $json_string;
