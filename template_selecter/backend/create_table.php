<?php
/* メインファンクション */
function create_table()
{
	/* 定数定義 */
	SetDefine();
	/* テーブル要素の生成 */
	$htmldata = SetTableData($htmldata);
	/* Html生成 */
	echo($htmldata);
}
/* 定数定義 */
function SetDefine()
{
	/* 探索ディレクトリの定義 */
	define( 'DIR_LINK'	,	'/etc/munin/');
	define( 'DIR_STATIC'	,	'/etc/munin/static_files/');
	define( 'DIR_TEMPLATE'	,	'/etc/munin/templates_files/');
}
/* シンボリックリンクの探索 */
function SearchSymbolicLink()
{
	/* ファイル一覧を取得 */
	$ArrFile = scandir( DIR_LINK );
	/* シンボリックリンク格納用配列 */
	$ArrSymbolic = array();
	/* ファイル一覧からシンボリックリンクを探索 */
	for ( $i = 0 ; $i < count($ArrFile) ; $i++ )
	{
		/* フルパスからファイル名を切り出し */
		$work = basename(readlink(DIR_LINK.$ArrFile[$i]));
		 
		if ( ! empty($work))
		{
			/* シンボリックリンクを配列に追加 */
			array_push( $ArrSymbolic , $work );
		}
	}
	return $ArrSymbolic;
}
/* スタティックファイルの探索 */
function SearchStatic()
{
	return scandir( DIR_STATIC );
}
/* テンプレートファイルの探索 */
function SearchTemplate()
{
	return scandir( DIR_TEMPLATE );
}
/* テーブルヘッダの生成 */
function SetTableHeader()
{
	$htmldata = <<< EOM
	<div class="templates">

EOM;
	return $htmldata;
}
/* テーブルフッタの生成 */
function SetTableFooter($htmldata)
{
	$htmldata .= <<< EOM

	</div>

EOM;
	return $htmldata;
}
/* テーブルラベルの生成 */
function SetTableLabel($htmldata)
{
	/* シンボリックリンクの探索 */
	$ArrSymbolic = SearchSymbolicLink();
	
	/* スタティックファイルの探索 */
	$ArrStatic = SearchStatic();
	/* テンプレートファイルの探索 */
	$ArrTemplate = SearchTemplate();
	/* ラベルの生成 */
	for ( $i = 0 ,$z = 0; $i < count($ArrStatic) ; $i++ )
	{
		/* 親/子ディレクトリを除く */
		if ( $ArrStatic[$i] != '.' and $ArrStatic[$i] != '..')
		{
			/* labelの添字をカウントアップ */
			$z++;
			
			/* 現在有効となっているリンクが処理中のラベルと同一名であるか */
			if ( in_array($ArrStatic[$i] , $ArrSymbolic))
			{
				/* 一致 */
				$checked = 'checked=""';
			} else {
				/* 不一致 */
				$checked = '';
			}
			$htmldata .= <<< EOM
                        <input type="radio" name="munin_radio" id="select{$z}" value="{$ArrStatic[$i]}" {$checked}>                                                         
                        <label for="select{$z}">{$ArrStatic[$i]}</label>
EOM;
		}
	}
	return $htmldata;
}
/* テーブル要素の生成 */
function SetTableData($htmldata)
{
	/* テーブルヘッダ生成 */
	$htmldata = SetTableHeader();
	/* テーブルラベル生成 */
	$htmldata = SetTableLabel($htmldata);
	/* テーブルフッタ生成 */
	$htmldata = SetTableFooter($htmldata);
	return $htmldata;
}
?>
