<?php
// vim: set filetype=php expandtab tabstop=2 shiftwidth=2 autoindent smartindent:

$mode = $_GET["mode"];
$cmd  = $_GET["cmd"];
$act  = $_GET["act"];
$id   = $_GET["id"];

$db_entry_size = 7;

class Vocab {
  public $id;
  public $score;
  public $time;
  public $eng;
  public $rom;
  public $hir;
  public $kanji;
  public $audio;

  public function __construct($id, $score, $time, $eng, $rom, $hir, $kanji, $audio) {
    $this->id    = $id;
    $this->score = $score;
    $this->time  = $time;
    $this->eng   = $eng;
    $this->rom   = $rom;
    $this->hir   = $hir;
    $this->kanji = $kanji;
    $this->audio = $audio;
  }
}

function get_entries($mode) {
  global $db_entry_size;

  $filename = "db/db";

  $fd = fopen($filename, "r") or die("Unable to open file!");

  $entries = [];

  $entry_count = 0;

  while(!feof($fd)){
    $line = trim(fgets($fd));
    if (strlen($line) == 0)
      continue;

    $args = split(",", substr($line,0,-1));

    if (count($args) != $db_entry_size) {
      error_log("in '{$filename}' line '{$line}' has incorrect # of entries");
      return [];
    }

    $entry = new Vocab(
        $entry_count++,
        $args[0],
        $args[1],
        $args[2],
        $args[3],
        $args[4],
        $args[5],
        $args[6]
        );
    $entries[] = $entry;
  }

  fclose($fd);	

  return $entries;
}

function get_random($mode) {
  $all = get_entries($mode);

  if (count($all) > 0) {
    return $all[0];
  } else {
    return NULL;
  }
}

function handle_cmd($mode, $cmd) {
  switch ($cmd) {
    case "rand":
      $rand = get_random($mode);

      header("Content-Type: application/json;charset=utf-8");
      print json_encode($rand);
      break;

    case "check":
      header("Content-Type: text/plaintext;charset=utf-8");

      $all = get_entries($mode);
      foreach ($all as $entry) {
        if (! file_exists("db/mp3/{$entry->audio}")) {
          printf("%u,%s: missing audio (db/mp3/%s)\n",
              $entry->id, $entry->eng, $entry->audio);
        }
      }
      print "done\n";

      break;

    case "all":
      $all = get_entries($mode);

      header("Content-Type: application/json;charset=utf-8");
      print json_encode($all);
      break;

    default:
      break;
  }
}

function handle_act($mode, $act, $id) {

//  struct db_entry_t *entry;
//  void (*func)(struct db_entry_t *);
//
//  if(strcmp(act, "inc") == 0)
//    func = db_entry_inc;
//  else if(strcmp(act, "dec") == 0)
//    func = db_entry_dec;
//  else if(strcmp(act, "zero") == 0)
//    func = db_entry_zero;
//  else if(strcmp(act, "reset") == 0)
//    func = db_entry_reset;
//  else
//    return false;
//
//  chkabort(db_open(&db, map->path));
//
//  entry = db_get(db, id);
//  if(entry != NULL)
//    func(entry);
//
//  db_save(db, map->path);
//  db_close(db);
//
//  if(entry == NULL)
//    return false;
//
//  hprintf(args->file, "ok", act, id, deck);
//  http_head_add(&args->resp, "Content-Type", "text/plaintext;charset=utf-8");


}

if ($cmd != "") {
  handle_cmd($mode, $cmd);
} else {
  handle_act($mode, $act, $id);
}

?>
