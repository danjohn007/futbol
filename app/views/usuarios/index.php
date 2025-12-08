<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-user-cog mr-2"></i>Gestión de Usuarios
    </h1>
    <p class="text-gray-600">Administración de usuarios del sistema</p>
</div>

<!-- Usuarios Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registro</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($usuarios as $usuario): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                            <?= strtoupper(substr($usuario['nombre'], 0, 1)) ?>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']) ?></div>
                            <?php if ($usuario['telefono']): ?>
                            <div class="text-sm text-gray-500"><?= htmlspecialchars($usuario['telefono']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= htmlspecialchars($usuario['email']) ?></div>
                    <?php if ($usuario['email_verificado']): ?>
                    <span class="text-xs text-green-600"><i class="fas fa-check-circle mr-1"></i>Verificado</span>
                    <?php else: ?>
                    <span class="text-xs text-gray-500"><i class="fas fa-exclamation-circle mr-1"></i>No verificado</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                        <?= htmlspecialchars($usuario['rol_nombre']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?= $usuario['activo'] ? 'green' : 'red' ?>-100 text-<?= $usuario['activo'] ? 'green' : 'red' ?>-800">
                        <?= $usuario['activo'] ? 'Activo' : 'Inactivo' ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= date('d/m/Y', strtotime($usuario['created_at'])) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 mr-3">
                        <i class="fas fa-edit"></i>
                    </button>
                    <?php if ($usuario['id'] != $user['id']): ?>
                    <button class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
    <?php
    $stats = [
        'total' => count($usuarios),
        'activos' => count(array_filter($usuarios, fn($u) => $u['activo'])),
        'verificados' => count(array_filter($usuarios, fn($u) => $u['email_verificado'])),
    ];
    ?>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Total Usuarios</div>
        <div class="text-2xl font-bold text-gray-800"><?= $stats['total'] ?></div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Usuarios Activos</div>
        <div class="text-2xl font-bold text-green-600"><?= $stats['activos'] ?></div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Emails Verificados</div>
        <div class="text-2xl font-bold text-blue-600"><?= $stats['verificados'] ?></div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Registros Hoy</div>
        <div class="text-2xl font-bold text-purple-600">
            <?= count(array_filter($usuarios, fn($u) => date('Y-m-d', strtotime($u['created_at'])) === date('Y-m-d'))) ?>
        </div>
    </div>
</div>

</main>
</div>
