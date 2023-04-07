<?php
function getSynonyms($word) {
    $thesaurus = array(
        "market" => array("trade"),
        "small" => array("little", "compact")
    );
    $synonyms = $thesaurus[$word] ?? [];
    return json_encode(array("word" => $word, "synonyms" => $synonyms));
}

echo getSynonyms("asleast");
?>