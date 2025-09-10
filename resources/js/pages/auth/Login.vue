<script setup lang="ts">
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import ThemeToggle from '@/components/ThemeToggle.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
    status?: string;
    canResetPassword?: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-center text-sm font-medium text-primary">
        {{ status }}
    </div>

    <Head title="Login">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <ThemeToggle />

    <!-- Fond global basé sur --background / --foreground -->
    <div class="relative min-h-screen bg-background text-foreground">
        <div class="flex min-h-screen flex-col items-center justify-center px-6 py-8 lg:py-0">
            <!-- Carte: couleurs via --card / --card-foreground + bordure -->
            <div class="w-full rounded-lg border border-border bg-card p-6 text-card-foreground shadow sm:max-w-md md:mt-0 lg:p-8">
                <h1 class="mb-4 text-center text-2xl leading-tight font-bold tracking-tight text-foreground">Zenith</h1>
                <p class="mb-6 text-center text-muted-foreground">Your progress one day at a time.</p>

                <div class="flex flex-col gap-4">
                    <Form
                        v-bind="AuthenticatedSessionController.store.form()"
                        :reset-on-success="['password']"
                        v-slot="{ errors, processing }"
                        class="flex flex-col gap-6"
                    >
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="email"
                                    placeholder="email@example.com"
                                    class="border border-input bg-background text-foreground focus-visible:ring-2 focus-visible:ring-ring"
                                />
                                <InputError :message="errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="flex items-center justify-between">
                                    <Label for="password">Password</Label>
                                    <TextLink :href="request()" class="text-sm text-primary hover:underline" :tabindex="5">
                                        Forgot password?
                                    </TextLink>
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    :tabindex="2"
                                    autocomplete="current-password"
                                    placeholder="Password"
                                    class="border border-input bg-background text-foreground focus-visible:ring-2 focus-visible:ring-ring"
                                />
                                <InputError :message="errors.password" />
                            </div>

                            <div class="flex items-center justify-between">
                                <Label for="remember" class="flex items-center gap-2 text-foreground">
                                    <Checkbox
                                        id="remember"
                                        name="remember"
                                        :tabindex="3"
                                        class="h-4 w-4 cursor-pointer rounded border border-border text-primary focus:ring-2 focus:ring-ring"
                                    />
                                    <span class="cursor-pointer">Remember me</span>
                                </Label>
                            </div>

                            <!-- Bouton: --primary / --primary-foreground / --ring -->
                            <Button
                                type="submit"
                                class="flex cursor-pointer items-center justify-center rounded-lg bg-primary px-4 py-2 text-primary-foreground hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                                :tabindex="4"
                                :disabled="processing"
                            >
                                <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                                Log in
                            </Button>
                        </div>
                    </Form>

                    <div class="text-center text-sm text-muted-foreground">
                        Don't have an account?
                        <TextLink :href="register()" :tabindex="5" class="text-primary hover:underline">Sign up</TextLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
