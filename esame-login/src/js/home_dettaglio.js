document.addEventListener("DOMContentLoaded", function () {
  var dettaglio = document.getElementById("dettaglio");
  dettaglio.style.display = "block";
});
// get the table element
var $table = document.getElementById("tab_dett"),
  // number of rows per page
  $n = 9,
  // number of rows of the table
  $rowCount = $table.rows.length,
  // get the first cell's tag name (in the first row)
  $firstRow = $table.rows[0].firstElementChild.tagName,
  // boolean var to check if table has a head row
  $hasHead = $firstRow === "TH",
  // an array to hold each row
  $tr = [],
  // loop counters, to start count from rows[1] (2nd row) if the first row has a head tag
  $i,
  $ii,
  $j = $hasHead ? 1 : 0,
  // holds the first row if it has a (<TH>) & nothing if (<TD>)
  $th = $hasHead ? $table.rows[0].outerHTML : "";
// count the number of pages
var $pageCount = Math.ceil($rowCount / $n);
// if we had one page only, then we have nothing to do ..
if ($pageCount > 1) {
  // assign each row outHTML (tag name & innerHTML) to the array
  for ($i = $j, $ii = 0; $i < $rowCount; $i++, $ii++)
    $tr[$ii] = $table.rows[$i].outerHTML;
  // create a div block to hold the buttons
  $table.insertAdjacentHTML("afterend", "<div id='buttons'></div");
  // the first sort, default page is the first one
  sort(1);
}
function sort($p) {
  var $rows = $th,
    $s = $n * $p - $n;
  for ($i = $s; $i < $s + $n && $i < $tr.length; $i++) $rows += $tr[$i];

  // now the table has a processed group of rows ..
  $table.innerHTML = $rows;
  // create the pagination buttons
  document.getElementById("buttons").innerHTML = pageButtons($pageCount, $p);
  // CSS Stuff
  document.getElementById("id" + $p).setAttribute("class", "active");
}

// ($pCount) : number of pages,($cur) : current page, the selected one ..
function pageButtons($pCount, $cur) {
  var $prevDis = $cur == 1 ? "disabled" : "",
    $nextDis = $cur == $pCount ? "disabled" : "",
    $buttons =
      "<input type='button' value='<< Precedente' onclick='sort(" +
      ($cur - 1) +
      ")' " +
      $prevDis +
      ">";
  for ($i = 1; $i <= $pCount; $i++)
    $buttons +=
      "<input type='button' id='id" +
      $i +
      "'value='" +
      $i +
      "' onclick='sort(" +
      $i +
      ")'>";
  $buttons +=
    "<input type='button' value='Prossimo >>' onclick='sort(" +
    ($cur + 1) +
    ")' " +
    $nextDis +
    ">";
  return $buttons;
}
