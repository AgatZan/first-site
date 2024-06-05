import os
cwd = os.path.dirname(os.path.abspath(__file__))
path_scheme:str = cwd+'/data/const/db/'
path_model:str = cwd+'/src/model/'

SELECT_TEMP = """<?php
namespace Model_{Table};

function select_templ($con, $select, $templ, $param){{
    $qu = $con->prepare("SELECT $select FROM `{table}` $templ");
    $st = $con->execute($param);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($st->fetchAll(\\PDO::FETCH_ASSOC));
}}
function select_where($con, $where, $what){{
    $qu = $con->prepare("SELECT * FROM `{table}` WHERE $where");
    $st = $con->execute($what);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($st->fetchAll(\\PDO::FETCH_ASSOC));
}}
function select($con, $from, $count=1000){{
    $qu = $con->prepare("SELECT * FROM `{table}` LIMIT ?,?");
    $st = $con->execute([$count, $from]);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($st->fetchAll(\\PDO::FETCH_ASSOC));
}}
function select_id($con, $id){{
    $qu = $con->prepare("SELECT * FROM `{table}` WHERE {select_id}");
    $st = $con->execute($id);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($st->fetchAll(\\PDO::FETCH_ASSOC));
}}
"""
INSERT_TEMP = """<?php
namespace Model_{Table};{foreign_req}

function insert(\\PDO $con{insert_param}
):\\Either{{
    $obj = [
       {insert_arr}
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}}
function insert_dto(\\PDO $con, $obj):\\Either{{ 
    {foreign_check}$set = '';
    $inset = '';
    foreach($obj as $key=>$val){{
        $set .= "$key,";
        $inset .= ":$key,";
    }}
    $set = substr($set, 0, -1);
    $inset = substr($inset, 0, -1);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES ($inset)
    ");
    $st = $qu->execute($obj);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($obj);
}}
function insert_many(\\PDO $con, $count, $obj){{
    {foreign_check}$set = '';
    $inset = str_repeat('({many_arg})', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \\Err(ID_ERROR) : new \\Ok($obj);
}}
"""
UPDATE_TEMP = """<?php
namespace Model_{Table};

function update( \\PDO $con{param_id}{update_param}
):\\Either{{
    $obj =[
       {update_id}{update_arr}
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}}
function update_dto(\\PDO $con, $obj):\\Either{{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `{table}` SET $set WHERE {where_id}");
    $st = $qu->execute($obj);
    return !$st? new \\Err(PASS_LOG_ERROR) : new \\Ok('');
}}
"""
DELETE_TEMP = """<?php
namespace Model_{Table};

function delete(\\PDO $con{param_id}
):\\Either{{
    $qu = $con->prepare("DELETE FROM `{table}` WHERE {where_id}");
    $st = $qu->execute([{delete_id}]);
    return !$st? new \\Err(ID_ERROR) : new \\Ok('');
}}
"""
CHECK_TEMP ="""<?php
namespace Model_{Table};

function check(\\PDO $con, $where, $what):bool{{
    $qu = $con->prepare("SELECT *  FROM `{table}` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\\PDO::FETCH_ASSOC);
    return boolval($obj);
}}
{needed_check}
"""
def parce_scheme(filename):
    obj = {
        'where_id':''
        , 'update_id':''
        , 'delete_id':''
        , 'param_id':''
        , 'select_id':''
        , 'insert_param':''
        , 'insert_arr':''
        , 'many_arg':''
        , 'update_param':''
        , 'update_arr':''
        , 'foreign_req':''
        , 'foreign_check':''
        , 'needed_check':{}
    }
    with open(os.path.abspath(filename), 'r', encoding='utf-8') as f:
        insert_pool = []
        insert_param_pool = []
        for line in f:
            match line.strip().split(' '):
                case [field]:
                    obj['insert_param'] += f'\n\t, ${field}'
                    obj['insert_arr'] += f" '{field}' => ${field}\n\t\t,"
                    obj['many_arg'] += '?,'
                    obj['update_param'] += f'\n\t, ${field} = NULL'
                    obj['update_arr'] += f" '{field}' => ${field}\n\t\t,"
                case [field, args]:
                    match args:
                        case 'PRIMARY':
                            obj['param_id'] += f"\n\t, ${field}"
                            obj['where_id'] += f"`{field}` = :{field}, "
                            obj['update_id'] += f" '{field}' => ${field}\n\t\t,"
                            obj['delete_id'] += f"'{field}' => ${field}, "
                            obj['select_id'] += obj.get('select_id') + f"AND `{field}`=?" if obj.get('select_id') else f"`{field}`=?"
                        case w if w in ['DEFAULT', 'DEFAULT+UPDATE']:
                            insert_pool.append(f" '{field}' => ${field}\n\t\t,")
                            insert_param_pool.append(f"\n\t, ${field} = NULL")
                            obj['update_param'] += f'\n\t, ${field} = NULL'
                            obj['update_arr'] += f" '{field}' => ${field}\n\t\t,"
                        case 'UPDATE':
                            obj['insert_param'] += f'\n\t, ${field}'
                            obj['insert_arr'] += f" '{field}' => ${field}\n\t\t,"
                            obj['many_arg'] += '?,'
                            obj['update_param'] += f'\n\t, ${field} = NULL'
                            obj['update_arr'] += f" '{field}' => ${field}\n\t\t,"
                case [field, tab, to]:
                    art = tab.split('+')
                    tab = art[0]
                    param = art[1] if 1 < len(art) else ''
                    to_model = f"Model_{tab.capitalize()}"
                    obj['foreign_req'] += f"\nrequire_once realpath(__DIR__ . '/../{to_model}/check');\n"
                    obj['needed_check'][tab] = obj['needed_check'].get(tab) or '' + f"function check_{to}($con, ${to}){{\n\treturn check($con,\"`{field}`=?`\", ${field});\n}}"
                    obj['foreign_check'] += f"if(! \\{to_model}\\check_{field}($con, $obj['{field}']) )\n\t\treturn ['status'=>ID_ERROR];\n\t"
                    if param == "PRIMARY":
                        obj['param_id'] += f"\n\t, ${field}"
                        obj['where_id'] += f"`{field}` = :{field}, "
                        obj['update_id'] += f" '{field}' => ${field}\n\t\t,"
                        obj['delete_id'] += f"'{field}' => ${field}, "
                        obj['select_id'] += obj.get('select_id') + f" AND `{field}`=?" if obj.get('select_id') else f"`{field}`=?"
                    else:
                        obj['update_param'] += f'\n\t, ${field} = NULL'
                        obj['update_arr'] += f" '{field}' => ${field}\n\t\t,"
                    obj['insert_param'] += f'\n\t, ${field}'
                    obj['insert_arr'] += f" '{field}' => ${field}\n\t\t,"
                    obj['many_arg'] += '?,'
    
    for (i,k) in enumerate(insert_pool):
        obj['insert_arr'] += k
        obj['insert_param'] += insert_param_pool[i]
        obj['many_arg'] += '?,'

    obj['where_id'] = obj['where_id'][:-2]
    # obj['param_id'] = obj['param_id'][:-3]
    # obj['insert_param'] = obj['insert_param'][:-3]
    # obj['update_param'] = obj['update_param'][:-3]
    obj['insert_arr'] = obj['insert_arr'][:-4]
    obj['many_arg'] = obj['many_arg'][:-1]
    obj['update_arr'] = obj['update_arr'][:-4]


    return obj


def create(filename, inner):
    with open(os.path.abspath(filename), 'w', encoding='utf-8') as f:
        f.write(inner)


with os.scandir(path_scheme) as d:
    check = {}
    for file in d:
        if file.name.endswith('.scheme'):
            table = file.name.split('.')[0]
            Table = table.capitalize()
            parced = parce_scheme(path_scheme+file.name)
            for (tab,need) in parced['needed_check'].items():
                check[tab] = check.get(tab) or ''
                if( not need in check[tab]): 
                    check[tab]+= need
            select_next = SELECT_TEMP.format(table=table,Table=Table, select_id=parced['select_id'])
            insert_next = INSERT_TEMP.format(table=table,Table=Table
                                             , foreign_req=parced['foreign_req']
                                             , foreign_check=parced['foreign_check']
                                             , insert_arr=parced['insert_arr']
                                             , many_arg = parced['many_arg']
                                             , insert_param=parced['insert_param'])
            
            update_next = UPDATE_TEMP.format(table=table,Table=Table
                                             , param_id=parced['param_id']
                                             , update_id=parced['update_id']
                                             , where_id=parced['where_id']
                                             , update_arr=parced['update_arr']
                                             , update_param=parced['update_param'])
            
            delete_next = DELETE_TEMP.format(table=table,Table=Table
                                             , param_id=parced['param_id']
                                             , where_id=parced['where_id']
                                             , delete_id=parced['delete_id'])

            Model = path_model + 'Model_' + Table
            if not os.path.isdir(Model):
                os.mkdir(Model)
            create(Model+'/select.php', select_next)
            create(Model+'/insert.php', insert_next)
            create(Model+'/update.php', update_next)
            create(Model+'/delete.php', delete_next)
    for (table,v) in check.items():
        Model = path_model + 'Model_' + table.capitalize()
        check_next = CHECK_TEMP.format(table=table, Table=table.capitalize(), needed_check=v)
        create(Model+'/check.php', check_next)


